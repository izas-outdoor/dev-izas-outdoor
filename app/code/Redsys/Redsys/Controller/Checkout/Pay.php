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

use Redsys\Redsys\Helper\Model\message\RESTInitialRequestMessage;
use Redsys\Redsys\Helper\Model\message\RESTOperationMessage;
use Redsys\Redsys\Helper\Service\Impl\RESTInitialRequestService;
use Redsys\Redsys\Helper\Service\Impl\RESTOperationService;
use Redsys\Redsys\Helper\Constants\RESTConstants;
use Redsys\Redsys\Helper\RedsysLibrary;
use Redsys\Redsys\Helper\OrderManager;
use Redsys\Redsys\Helper\CurrencyManager;

use Redsys\Redsys\Helper\RedsysApi;

class Pay extends \Magento\Framework\App\Action\Action
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

		$miObj = new RedsysApi();
		$moduleInfo = "MG_iPURv" . $miObj->getModuleVersion();

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

			//Peticion de datos de tarjeta. (IniciaPeticion)
			$initialRequest = new RESTInitialRequestMessage();
			$initialRequest->setAmount($amount);
			$initialRequest->setCurrency($moneda);
			$initialRequest->setMerchant($redsysController->get_num());
			$initialRequest->setTerminal($redsysController->get_terminal());
			$initialRequest->setOrder($_POST['numPed']);
			$initialRequest->setOperID($_POST['operID']);
			$initialRequest->setTransactionType($redsysController->get_tipopago());
			$initialRequest->demandCardData();

			RedsysLibrary::escribirLog("DEBUG", $idLog, $_POST['numPed'], null, __METHOD__);

			$service = new RESTInitialRequestService($redsysController->get_clave256(), $redsysController->get_entorno());
			$initialResult = $service->sendOperation($initialRequest, $idLog);

			//Creación de objeto para la petición.
			$request = new RESTOperationMessage();
			$request->setAmount($amount);
			$request->setCurrency($moneda);
			$request->setMerchant($redsysController->get_num());
			$request->setTerminal($redsysController->get_terminal());
			$request->setOrder($_POST['numPed']);
			$request->setOperID($_POST['operID']);
			$request->setTransactionType($redsysController->get_tipopago());
			$request->addParameter("DS_MERCHANT_TITULAR", $titular);
			$request->addParameter("DS_MERCHANT_PRODUCTDESCRIPTION", $productdescription);
			$request->addParameter("DS_MERCHANT_MODULE", $moduleInfo);
			$ip = $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'];
			$request->addParameter("DS_MERCHANT_CLIENTIP", $ip);
			$ThreeDSParams = $_POST["valores3DS"];
			$ThreeDSInfo = $initialResult->protocolVersionAnalysis();

			$autback_url = $redsysController->createEndpointParams($redsysController->get_baseURL() . "redsys/checkout/autback", $request, $_POST['idCart'], $ThreeDSInfo);
			$session->setData('REDSYS_termurl', $autback_url);

			if ($redsysController->get_ref() && $_POST['save']) {
				$request->createReference();
			}
			if ($redsysController->get_activar3ds()) {
				if ($ThreeDSInfo == "1.0.2") {

					$request->setEMV3DSParamsV1();
				} else {

					$decoded3DS = json_decode(str_replace("\\", "", $ThreeDSParams));

					$browserAcceptHeader = "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8,application/json";
					$browserUserAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36";
					$browserJavaEnable = $decoded3DS->browserJavaEnabled;
					$browserJavaScriptEnabled = $decoded3DS->browserJavascriptEnabled;
					$browserLanguage = $decoded3DS->browserLanguage;
					$browserColorDepth = $decoded3DS->browserColorDepth;
					$browserScreenHeight = $decoded3DS->browserScreenHeight;
					$browserScreenWidth = $decoded3DS->browserScreenWidth;
					$browserTZ = $decoded3DS->browserTZ;
					$threeDSCompInd = $decoded3DS->browserUserAgent;
					$threeDSServerTransID = $initialResult->getThreeDSServerTransID();
					$notificationURL = $autback_url;

					$request->setEMV3DSParamsV2($ThreeDSInfo, $browserAcceptHeader, $browserUserAgent, $browserJavaEnable, $browserJavaScriptEnabled, $browserLanguage, $browserColorDepth, $browserScreenHeight, $browserScreenWidth, $browserTZ, $threeDSServerTransID, $notificationURL, $threeDSCompInd);
				}
			} else {
				$request->useDirectPayment();
			}

			$service = new RESTOperationService($redsysController->get_clave256(), $redsysController->get_entorno());
			$result = $service->sendOperation($request, $idLog);
			$ThreeDSInfo = $result->protocolVersionAnalysis();

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
				$jsonObj = array();

				$jsonObj['amount']          = $result->getOperation()->getAmount();
				$jsonObj['currency']        = $result->getOperation()->getCurrency();
				$jsonObj['order']           = $result->getOperation()->getOrder();
				$jsonObj['signature']       = $result->getOperation()->getSignature();
				$jsonObj['merchant']        = $result->getOperation()->getMerchant();
				$jsonObj['terminal']        = $result->getOperation()->getTerminal();
				$jsonObj['transactionType'] = $result->getOperation()->getTransactionType();
				$jsonObj['protocolVersion']	= $result->getOperation()->getProtocolVersion();

				$encoded = json_encode($jsonObj);

				RedsysLibrary::escribirLog("DEBUG", $idLog, "Versión de PHP: " . PHP_VERSION, null, __METHOD__);

				if (version_compare(PHP_VERSION, '7.3.0') >= 0) {

					setcookie('rs_oper', $encoded, ['samesite' => 'None', 'secure' => true]);
				} else {

					header('Set-Cookie: rs_oper=' . $encoded . '; SameSite=None; Secure');
				}

				if ($ThreeDSInfo == "1.0.2") {

					$session->setData('REDSYS_oper', serialize($result->getOperation()));
					$session->setData('REDSYS_pareq', $result->getPAReqParameter());
					$session->setData('REDSYS_urlacs', $result->getAcsURLParameter());
					$session->setData('REDSYS_md', $result->getMDParameter());

					//die(json_encode(array("redir"=>false, "url"=>$this->secure_redir_url)));
					die(json_encode(array("redir" => false, "url" => $redsysController->get_baseURL() . 'redsys/checkout/aut?form_key=' . $redsysController->get_formKey()->getFormKey())));
				} else {

					$session->setData('REDSYS_oper', serialize($result->getOperation()));
					$session->setData('REDSYS_creq', $result->getCreqParameter());
					$session->setData('REDSYS_urlacs', $result->getAcsURLParameter());

					//die(json_encode(array("redir"=>false, "url"=>$this->secure_redir_v2_url)));
					die(json_encode(array("redir" => false, "url" => $redsysController->get_baseURL() . 'redsys/checkout/aut?form_key=' . $redsysController->get_formKey()->getFormKey())));
				}

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
