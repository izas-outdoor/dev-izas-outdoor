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

namespace Redsys\Redsys\Controller\Checkout;

use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\DB\Transaction;
use Magento\Framework\View\Result\PageFactory;
use Magento\Sales\Model\Order\Email\Sender\InvoiceSender;
use Magento\Sales\Model\Service\InvoiceService;
use Magento\Sales\Model\Order\Invoice;
use Magento\Sales\Api\InvoiceRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;

// use Magento\Framework\App\CsrfAwareActionInterface;

use Redsys\Redsys\Controller\RedsysController;
use Redsys\Redsys\Helper\RedsysApi;
use Redsys\Redsys\Helper\RedsysLibrary;

class Notify extends \Magento\Framework\App\Action\Action /* implements \Magento\Framework\App\CsrfAwareActionInterface */
{
	protected $_resultPageFactory;
	protected $_redsysController;
	protected $_session;
	protected $_invoiceService;
	protected $_invoiceSender;
	protected $_cart;
	protected $_formKey;
	protected $_productRepository;

	public function __construct(Context $context, Session $session, PageFactory $resultPageFactory, StoreManagerInterface $storeManager, RedsysController $redsysController, InvoiceService $invoiceService, InvoiceSender $invoiceSender, Cart $cart, ProductRepository $productRepository, FormKey $formKey, InvoiceRepositoryInterface $invoiceRepository, Transaction $transaction)
	{
		$this->_session = $session;
		$this->_invoiceSender = $invoiceSender;
		$this->_invoiceService = $invoiceService;
		$this->_redsysController = $redsysController;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_cart = $cart;
		$this->_formKey = $formKey;
		$this->_productRepository = $productRepository;

		$this->invoiceService     = $invoiceService;
		$this->invoiceRepository  = $invoiceRepository;
		$this->transaction        = $transaction;

		parent::__construct($context);
	}

/*
	public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException 
	{
		return null;
	}

	public function validateForCsrf(RequestInterface $request): ?bool
	{
		return true;
	}
*/
	
	private function validateRequest(
		HttpRequest $request,
		ActionInterface $action
	) {
		$valid = null;
		if ($action instanceof CsrfAwareActionInterface) {
			$valid = $action->validateForCsrf($request);
		}
		if ($valid === null) {
			$valid = !$request->isPost()
				|| $request->isAjax()
				|| $this->formKeyValidator->validate($request);
		}

		return $valid;
	}
	

	public function execute()
	{
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->append(__("Notificacion") . " - Redsys");
		$resultPage->getLayout()->initMessages();

		RedsysLibrary::escribirLog("INFO ", "00000debug00000", "AAAAA", 3, __METHOD__);

		$version = null;
		$datos = null;
		$firma_remota = null;
		$hayDatos = false;
		$esPost = false;
		$logActivo = $this->_redsysController->get_logactivo();
		$clave256 = $this->_redsysController->get_clave256();


		if (!empty($_POST)) //URL RESP. ONLINE
		{
			$version     = $_POST["Ds_SignatureVersion"];
			$datos    = $_POST["Ds_MerchantParameters"];
			$firma_remota    = $_POST["Ds_Signature"];
			$hayDatos = true;
			$esPost = true;
		} else if (!empty($_GET)) //URL RESP. ONLINE
		{
			$version     	= $_GET["Ds_SignatureVersion"];
			$datos    		= $_GET["Ds_MerchantParameters"];
			$firma_remota   = $_GET["Ds_Signature"];
			$hayDatos = true;
			$esPost = false;
		}

		$miObj = new RedsysApi();
		$decodec = $miObj->decodeMerchantParameters($datos);
		$firma_local = $miObj->createMerchantSignatureNotif($clave256, $datos, $logActivo);

		$merchantData = RedsysLibrary::b64url_decode($miObj->getParameter('Ds_MerchantData'));
		$merchantData = json_decode($merchantData);
		$pedidoSecuencial = $merchantData->idCart;

		$idLog = RedsysLibrary::generateIdLog($logActivo, $pedidoSecuencial);

		RedsysLibrary::escribirLog("DEBUG", $idLog, "Parámetros POST recibidos: " . print_r($_POST, true), null, __METHOD__);
		RedsysLibrary::escribirLog("DEBUG", $idLog, "Parámetros GET recibidos:  " . print_r($_GET, true), null, __METHOD__);

		if ($hayDatos) {
			$resValidacion = $this->validaPedido($version, $datos, $firma_remota, $idLog, $logActivo);
			$order = $resValidacion['order'];

			switch ($resValidacion['resultado']) {
				case 1:
					if ($esPost) {
						RedsysLibrary::escribirLog("INFO ", $idLog, "Validaciones no superadas", null, __METHOD__);

						$order->cancel()->setState(\Magento\Sales\Model\Order::STATE_CANCELED, 'canceled', 'El pedido ha sido cancelado.', false)->save();
						RedsysLibrary::escribirLog("INFO ", $idLog, "Pedido cancelado", null, __METHOD__);
						RedsysLibrary::escribirLog("INFO ", $idLog, "Respuesta del SIS: " . $resValidacion['respuesta_sis'], null, __METHOD__);

						$order->addStatusHistoryComment($resValidacion['comentario'], false)
							->setIsCustomerNotified(false)
							->save();

						die(__("Validaciones NO superadas"));
					} else {
						if ($order && $this->_cart->getItemsCount() == 0) {
							$orderItems = $order->getAllItems();
							if ($orderItems) {
								foreach ($orderItems as $item) {
									$info = $item->getProductOptionByCode('info_buyRequest');
									$params = array(
										'form_key'	=> $this->_formKey->getFormKey(),
									);
									$product = $this->_productRepository->getById($item->getProductId());

									$this->_cart->addProduct($product, $params + $info);
								}
								$this->_cart->save();
							}
						}

						$resultPage->getLayout()->getBlock('redsys_checkout_notify')->setExito(2);
						$resultPage->getLayout()->getBlock('redsys_checkout_notify')->setURL($this->_redsysController->get_baseURL());
					}
					break;
				case 2:
					if ($esPost) {
						if ($order) {
							if ($order->canCancel()) {
								try {
									$order->cancel();
									$order->save();

									$order->addStatusHistoryComment(__("Pedido cancelado por Redsys."), false)
										->setIsCustomerNotified(false)
										->save();
								} catch (Exception $e) {
									RedsysLibrary::escribirLog("ERROR", $idLog, "Excepción capturada en la cancelación", null, __METHOD__);
									$order->addStatusHistoryComment('Redsys: Exception message: ' . $e->getMessage(), false);
									$order->save();
								}
							}
						}

						RedsysLibrary::escribirLog("INFO ", $idLog, "Validaciones no superadas", null, __METHOD__);
						die(__("Validaciones NO superadas"));
					} else {
						$resultPage->getLayout()->getBlock('redsys_checkout_notify')->setExito(3);
					}
					break;
				default:
					if ($esPost) {
						RedsysLibrary::escribirLog("INFO ", $idLog, "Pedido validado con éxito", null, __METHOD__);
						RedsysLibrary::escribirLog("INFO ", $idLog, "Respuesta del SIS: " . $resValidacion['respuesta_sis'], null, __METHOD__);
						$this->confirmaPedido($order, $resValidacion['pedido'], $resValidacion['total'], $idLog, $resValidacion['respuesta_sis']);

						die(__("Validaciones superadas"));
					} else {
						RedsysLibrary::escribirLog("INFO ", $idLog, "Pedido validado con éxito", null, __METHOD__);
						RedsysLibrary::escribirLog("INFO ", $idLog, "Respuesta del SIS: " . $resValidacion['respuesta_sis'], null, __METHOD__);
						$this->confirmaPedido($order, $resValidacion['pedido'], $resValidacion['total'], $idLog, $resValidacion['respuesta_sis']);
						
						$resultPage->getLayout()->getBlock('redsys_checkout_notify')->setExito(0);
					}
					break;
			}
		} else {
			RedsysLibrary::escribirLog("ERROR", $idLog, "La notificación está vacía", null, __METHOD__);
			$resultPage->getLayout()->getBlock('redsys_checkout_notify')->setExito(1);
		}
		return $resultPage;
	}

	private function validaPedido($version, $datos, $firma_remota, $idLog, $logActivo)
	{

		$mantenerPedidoAnteError = $this->_redsysController->get_errorpago();
		$clave256 = $this->_redsysController->get_clave256();

		/** Extraer datos locales **/
		$codigoOrig =    $this->_redsysController->get_num();
		$terminalOrig =  $this->_redsysController->get_terminal();
		//$tipoTransOrig = $this->_redsysController->get_trans();
		$monedaOrig =    $this->_redsysController->get_moneda();
		if ($monedaOrig == "0")
			$monedaOrig = "978";
		else
			$monedaOrig = "840";

		$miObj = new RedsysApi();
		$decodec = $miObj->decodeMerchantParameters($datos);
		$firma_local = $miObj->createMerchantSignatureNotif($clave256, $datos, $logActivo);

		RedsysLibrary::escribirLog("INFO ", $idLog, "***** VALIDACIÓN DE LA NOTIFICACIÓN ── PEDIDO " . $miObj->getParameter('Ds_Order') . " *****", null, __METHOD__);

		RedsysLibrary::escribirLog("DEBUG", $idLog, "Parámetros de la respuesta del SIS: " . $datos, null, __METHOD__);
		RedsysLibrary::escribirLog("DEBUG", $idLog, "Firma de los parámetros RECIBIDA : " . $firma_remota, null, __METHOD__);
		RedsysLibrary::escribirLog("DEBUG", $idLog, "Firma de los parámetros CALCULADA: " . $firma_local, null, __METHOD__);


		/** Extraer datos de la notificación **/
		$total     = $miObj->getParameter('Ds_Amount');
		$pedido    = $miObj->getParameter('Ds_Order');
		$codigo    = $miObj->getParameter('Ds_MerchantCode');
		$terminal  = $miObj->getParameter('Ds_Terminal');
		$moneda    = $miObj->getParameter('Ds_Currency');
		$respuesta = $miObj->getParameter('Ds_Response');
		$fecha	   = $miObj->getParameter('Ds_Date');
		$hora	   = $miObj->getParameter('Ds_Hour');
		$id_trans  = $miObj->getParameter('Ds_AuthorisationCode');
		//$tipoTrans = $miObj->getParameter('Ds_actionType');


		$respuestaSIS = RedsysLibrary::checkRespuestaSIS($respuesta, $id_trans);

		$merchantData = RedsysLibrary::b64url_decode($miObj->getParameter('Ds_MerchantData'));
		$merchantData = json_decode($merchantData);
		$pedidoSecuencial = $merchantData->idCart;

		$totalOrig = 0;
		$order = null;
		if (RedsysLibrary::checkPedidoAlfaNum($pedidoSecuencial)) {
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$order = $objectManager->create('\Magento\Sales\Model\Order')->load($pedidoSecuencial);
			$totalOrig = floatval($order->getTotalDue()) * 100;
		}

		if (
			RedsysLibrary::checkFirma($firma_local, $firma_remota)
			&& RedsysLibrary::checkImporte($total)
			&& RedsysLibrary::checkPedidoAlfaNum($pedido, $this->_redsysController->get_pedidoextendido() == 1)
			&& RedsysLibrary::checkFuc($codigo)
			&& RedsysLibrary::checkMoneda($moneda)
			&& RedsysLibrary::checkRespuesta($respuesta)
			&& intval($respuesta) < 100
		) {

			RedsysLibrary::escribirLog("DEBUG", $idLog, "Validación de parámetros completada", null, __METHOD__);

			if ($miObj->existParameter('Ds_Merchant_Identifier')) {
				$reference = $miObj->getParameter('Ds_Merchant_Identifier');
				$cardNumber = '';
				$brand = '';
				$cardType = '';

				if ($miObj->existParameter('Ds_Card_Number')) {
					$brand = $miObj->getParameter('Ds_Card_Brand');
					$cardNumber = $miObj->getParameter('Ds_Card_Number');
				}
				$this->_redsysController->get_reference()->saveReference($this->_redsysController->get_customerId(), $reference, $cardNumber, $brand, $cardType);
			}

			return array(
				'resultado' => 0, 
				'order' => $order, 
				'pedido' => $pedido,
				'total' => $total,
				'respuesta_sis' => $respuestaSIS[0]
			);
		} else {
			$comentario = "REDSYS - Error desconocido.";
			if (!($firma_local === $firma_remota)) {
				RedsysLibrary::escribirLog("ERROR", $idLog, "La firma no coincide.", null, __METHOD__);
				$comentario = "REDSYS - Error de firma.";
			} else {
				if (intval($respuesta) >= 100) {
					RedsysLibrary::escribirLog("INFO ", $idLog, "Respuesta KO del SIS: " . $respuesta, null, __METHOD__);
					//					$comentario = RedsysLibrary::textDsResponse($respuesta);
				}
			}

			RedsysLibrary::escribirLog(
				"ERROR",
				$idLog,
				"Error validando el pedido con ID de carrito " . $pedidoSecuencial . " (" . $pedido . "). Resultado de las validaciones [Firma|Respuesta|Moneda|FUC|Pedido|Importe|Respuesta]: [" .
					RedsysLibrary::checkFirma($firma_local, $firma_remota) . "|" .
					RedsysLibrary::checkRespuesta($respuesta) . "|" .
					RedsysLibrary::checkMoneda($moneda) . "|" .
					RedsysLibrary::checkFuc($codigo) . "|" .
					RedsysLibrary::checkPedidoAlfaNum($pedido, $this->_redsysController->get_pedidoextendido() == 1) . "|" .
					RedsysLibrary::checkImporte($total) . "|" .
					intval($respuesta) . "]",
				null,
				__METHOD__
			);

			if ($mantenerPedidoAnteError) {
				return array(
					'resultado' => 1, 
					'order' => $order, 
					'comentario' => $comentario, 
					'respuesta' => $respuesta,
					'total' => $total,
					'respuesta_sis' => $respuestaSIS[0]
				);
			} else {
				return array(
					'resultado' => 2, 
					'order' => $order, 
					'comentario' => $comentario,
					'total' => $total,
					'respuesta_sis' => $respuestaSIS[0]
				);
			}
		}
	}

	private function confirmaPedido($order, $pedido, $amount, $idLog, $comentario)
	{
		try {
			$estado=$this->_redsysController->get_estado();
			$order->setBaseTotalPaid($order->getBaseTotalDue());
			$order->setTotalPaid($order->getTotalDue());
    		$order->setState('new')->setStatus($estado)->save();
			$order->addStatusHistoryComment("Respuesta del SIS: " . $comentario, false);
			$order->addStatusHistoryComment(__("Pago con Redsys registrado con éxito."), false)
				->setIsCustomerNotified(true)
				->save();

			if(!$order->canInvoice()) {
				$order->addStatusHistoryComment(__("Redsys, imposible generar Factura."), false);
				$order->save();
			} else {
				$transaction = new Transaction();

				$invoice=$this->_invoiceService->prepareInvoice($order);
				$invoice->register();
				$invoice->setTransactionId($pedido);
				$invoice->pay();
				$invoice->save();
				$transactionSave = $transaction->addObject($invoice)->addObject($invoice->getOrder());
				$transactionSave->save();

				if (!@$this->_invoiceSender->send($invoice))
					$order->addStatusHistoryComment(__("Redsys, imposible enviar Factura."), false);

				$order->addStatusHistoryComment(__("Redsys ha generado la Factura del pedido"), false)->save();
			}

			$permiteDevolucion = $order->canCreditmemo();

			if ($order->canCreditmemo())
				RedsysLibrary::escribirLog("DEBUG", $idLog, "La orden permite devolución", null, __METHOD__);
			else
				RedsysLibrary::escribirLog("DEBUG", $idLog, "La orden no permite devolución", null, __METHOD__);
		} catch (Exception $e) {
			RedsysLibrary::escribirLog("ERROR", $idLog, "Excepción capturada en la confirmación", null, __METHOD__);
			$order->addStatusHistoryComment('Redsys: Exception message: ' . $e->getMessage(), false);
			$order->save();
		}
	}
}
