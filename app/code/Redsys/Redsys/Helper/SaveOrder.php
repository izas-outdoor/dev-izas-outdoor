<?php
/**
* NOTA SOBRE LA LICENCIA DE USO DEL SOFTWARE
* 
* El uso de este software está sujeto a las Condiciones de uso de software que
* se incluyen en el paquete en el documento "Aviso Legal.pdf". También puede
* obtener una copia en la siguiente url:
* http://www.redsys.es/wps/portal/redsys/publica/areadeserviciosweb/descargaDeDocumentacionYEjecutables
* 
* Redsys es titular de todos los derechos de propiedad intelectual e industrial
* del software.
* 
* Quedan expresamente prohibidas la reproducción, la distribución y la
* comunicación pública, incluida su modalidad de puesta a disposición con fines
* distintos a los descritos en las Condiciones de uso.
* 
* Redsys se reserva la posibilidad de ejercer las acciones legales que le
* correspondan para hacer valer sus derechos frente a cualquier infracción de
* los derechos de propiedad intelectual y/o industrial.
* 
* Redsys Servicios de Procesamiento, S.L., CIF B85955367
*/

namespace Redsys\Redsys\Helper;

use Magento\Framework\DB\Transaction;
use Redsys\Redsys\Helper\RedsysLibrary;

class SaveOrder {
	public static function SaveOrder($order, $redsysController, $invoiceService, $invoiceSender, $pedido, $idLog = NULL) {
		try {
			$estado = $redsysController->get_estado();
			$order->setBaseTotalPaid($order->getBaseTotalDue());
			$order->setTotalPaid($order->getTotalDue());
			$order->setState('new')->setStatus($estado)->save();
			$order->addStatusHistoryComment(__("Pago con Redsys registrado con éxito."), false)
				->setIsCustomerNotified(false)
				->save();

			if(!$order->canInvoice()) {
				$order->addStatusHistoryComment(__("Redsys, imposible generar Factura."), false);
				$order->save();
			}
			else {
				$transaction = new Transaction();
				$invoice = $invoiceService->prepareInvoice($order);
				$invoice->register();
				$invoice->setTransactionId($pedido);
				$invoice->pay();
				$invoice->save();
				$transactionSave = $transaction->addObject($invoice)->addObject($invoice->getOrder());
				$transactionSave->save();
				if (!@$invoiceSender->send($invoice)){
					$order->addStatusHistoryComment(__("Redsys, imposible enviar Factura."), false);
				}
				$order->addStatusHistoryComment(__("Redsys ha generado la Factura del pedido"), false)->save();
			}
			if ($redsysController->get_correo()) {
				$nombreComercio = $redsysController->get_nombre();
				$mensaje = $redsysController->get_mensaje();
				$email_to = $order->getCustomerEmail();
				$email_subject = "-MAGENTO- Pedido realizado";
				if(!@mail($email_to, $email_subject, $mensaje, "From:" . $nombreComercio)){
					$order->addStatusHistoryComment(__("Redsys, imposible enviar correo."), false);
				}
			}
		}
		catch (\Exception $e) {
			$order->addStatusHistoryComment('Redsys: Exception message: '.$e->getMessage(), false);
			$order->save();
			RedsysLibrary::escribirLog("ERROR", $idLog, "Pedido " . $order->getId() . ". Excepción " . $e, null, __METHOD__);
		}
	}
}