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

use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Session;
use Magento\Sales\Model\Service\InvoiceService;
use Magento\Sales\Model\Order\Email\Sender\InvoiceSender;
use Redsys\Redsys\Controller\RedsysInsiteController;

use Redsys\Redsys\Helper\Model\message\RESTOperationMessage;
use Redsys\Redsys\Helper\Service\Impl\RESTOperationService;
use Redsys\Redsys\Helper\Constants\RESTConstants;
use Redsys\Redsys\Helper\RedsysLibrary;
use Redsys\Redsys\Helper\OrderManager;
use Redsys\Redsys\Helper\CurrencyManager;

class Ref extends \Magento\Framework\App\Action\Action
{
	protected $_session;
	protected $_redsysController;
	protected $_invoiceService;
	protected $_invoiceSender;
	protected $_customerId;
	protected $_reference;

	public function __construct(Context $context, Session $session, RedsysInsiteController $redsysController, InvoiceService $invoiceService, InvoiceSender $invoiceSender)
	{
		$this->_session = $session;
		$this->_redsysController = $redsysController;
		$this->_invoiceService = $invoiceService;
		$this->_invoiceSender = $invoiceSender;
		return parent::__construct($context);
	}

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

	private function get_session()
	{
		return $this->_session;
	}

	private function get_redsysController()
	{
		return $this->_redsysController;
	}

	private function get_invoiceService()
	{
		return $this->_invoiceService;
	}

	private function get_invoiceSender()
	{
		return $this->_invoiceSender;
	}

	public function execute()
	{
		$session = $this->get_session();
		$redsysController = $this->get_redsysController();

		$order = $session->getLastRealOrder();
		$orderId = $order->getId();
		if ($orderId) {

			$idLog = RedsysLibrary::generateIdLog($redsysController->get_logactivo(), $orderId);

			$orderItems = $order->getAllItems();
			$amount = CurrencyManager::GetAmount($order->getTotalDue(), $redsysController->get_moneda());
			$moneda = CurrencyManager::CurrencyCode($redsysController->get_moneda());
			$titular = $order->getCustomerFirstname() . " " . $order->getCustomerLastname() . "/ " . __("Correo") . ": " . $order->getCustomerEmail();
			$productdescription = "";
			foreach ($orderItems as $item) {
				if ($item->getQtyOrdered() % 1 != 0)
					$cant = $item->getQtyOrdered();
				else
					$cant = intval($item->getQtyOrdered());

				$productdescription .= $item->getName() . "x" . $cant . " / ";
			}
			$ref = $redsysController->get_reference()->getCustomerRef($redsysController->get_customerId());
			$request = new RESTOperationMessage();
			$request->setAmount($amount);
			$request->setCurrency($moneda);
			$request->setMerchant($redsysController->get_num());
			$request->setTerminal($redsysController->get_terminal());
			$request->setOrder($_POST['numPed']);
			$request->setTransactionType($redsysController->get_trans());
			$request->addParameter("DS_MERCHANT_TITULAR", $titular);
			$request->addParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $productdescription);
			$request->addParameter("DS_MERCHANT_MODULE", "M2_redsys_4.0.0");
			$request->useReference($ref[0]);
			$request->useDirectPayment();
			$ip = $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'];
			$request->addParameter("DS_MERCHANT_CLIENTIP", $ip);

			// if ($redsysController->get_3ds()) {
			// 	$request->useSecurePayment();
			// }
			// else {
			// 	$request->useDirectPayment();
			// }

			$service = new RESTOperationService($redsysController->get_clave256(), $redsysController->get_entorno());
			$result = $service->sendOperation($request);

			$respuestaSIS = RedsysLibrary::checkRespuestaSIS($result->getApiCode(), $result->getAuthCode());

			if ($result->getResult() == RESTConstants::$RESP_LITERAL_OK) {
				$reference = $result->getOperation()->getMerchantIdentifier();
				if ($reference != null && $redsysController->get_customerId()) {
					$cardNumber = $result->getOperation()->getCardNumber();
					$brand = $result->getOperation()->getCardBrand();
					$cardType = $result->getOperation()->getCardType();
					$redsysController->get_reference()->saveReference($redsysController->get_customerId(), $reference, $cardNumber, $brand, $cardType);
				}
				$pedido = $result->getOperation()->getOrder();
				OrderManager::SaveOrder($order, $redsysController, $this->get_invoiceService(), $this->get_invoiceSender(), $pedido, $respuestaSIS[0]);
				header('Content-Type: application/json');
				die(json_encode(array("redir" => true, "url" => $redsysController->get_baseURL() . 'redsys/checkout/success')));
			} elseif ($result->getResult() == RESTConstants::$RESP_LITERAL_AUT) {
				$session->setData('REDSYS_oper', serialize($result->getOperation()));
				$session->setData('REDSYS_pareq', $result->getOperation()->getPaRequest());
				$session->setData('REDSYS_urlacs', $result->getOperation()->getAcsUrl());
				$session->setData('REDSYS_md', $result->getOperation()->getAutSession());

				header('Content-Type: application/json');
				die(json_encode(array("redir" => false, "url" => $redsysController->get_baseURL() . 'redsys/checkout/aut?form_key=' . $redsysController->get_formKey()->getFormKey())));
			} else {
				RedsysLibrary::escribirLog("ERROR", $idLog, "Recibido KO. Respuesta del SIS: " . $respuestaSIS[0], null, __METHOD__);

				header('Content-Type: application/json');
				die(json_encode(array("redir" => true, "url" => $redsysController->get_baseURL() . 'redsys/checkout/error?form_key=' . $redsysController->get_formKey()->getFormKey())));
			}
		}
	}
}
