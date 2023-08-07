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

use Redsys\Redsys\Helper\OrderManager;
use Redsys\Redsys\Helper\Model\message\RESTAuthenticationRequestMessage;
use Redsys\Redsys\Helper\Service\Impl\RESTAuthenticationRequestService;
use Redsys\Redsys\Helper\Constants\RESTConstants;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Redsys\Redsys\Helper\RedsysLibrary;

class Autback extends \Magento\Framework\App\Action\Action implements \Magento\Framework\App\CsrfAwareActionInterface
{
	protected $_session;
	protected $_redsysController;
	protected $_invoiceService;
	protected $_invoiceSender;

	public function __construct(
		Context $context,
		Session $session,
		RedsysInsiteController $redsysController,
		InvoiceService $invoiceService,
		InvoiceSender $invoiceSender
	) {

		$this->_session = $session;
		$this->_redsysController = $redsysController;
		$this->_invoiceService = $invoiceService;
		$this->_invoiceSender = $invoiceSender;

		return parent::__construct($context);
	}

	public function createCsrfValidationException(
		RequestInterface $request
		): ?InvalidRequestException {
		return null;
	}
	   
	public function validateForCsrf(RequestInterface $request): ?bool
	{
		return true;
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

	public function get_session()
	{
		return $this->_session;
	}

	public function get_redsysController()
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

		$idLog = RedsysLibrary::generateIdLog($redsysController->get_logactivo(), $_GET['idCart']);

		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$order = $objectManager->create('Magento\Sales\Model\Order')->load($_GET['idCart']);

		$urlTienda = $redsysController->get_baseURL() . 'redsys/checkout/error?form_key=' . $redsysController->get_formKey()->getFormKey();

		$request = new RESTAuthenticationRequestMessage();
		$request->setOrder($_GET['order']);
		$request->setAmount($_GET['amount']);
		$request->setCurrency($_GET['currency']);
		$request->setMerchant($_GET['merchant']);
		$request->setTerminal($_GET['terminal']);
		$request->setTransactionType($_GET['transactionType']);
		$request->addEmvParameter(RESTConstants::$RESPONSE_JSON_THREEDSINFO_ENTRY, RESTConstants::$RESPONSE_3DS_CHALLENGE_RESPONSE);
		$request->addEmvParameter(RESTConstants::$RESPONSE_JSON_PROTOCOL_VERSION_ENTRY, $_GET['protocolVersion']);
		if (isset($_POST["PaRes"])) $request->addEmvParameter(RESTConstants::$RESPONSE_JSON_PARES_ENTRY, $_POST["PaRes"]);
		if (isset($_POST["MD"])) $request->addEmvParameter(RESTConstants::$RESPONSE_JSON_MD_ENTRY, $_POST["MD"]);
		if (isset($_POST["cres"])) $request->addEmvParameter(RESTConstants::$RESPONSE_MERCHANT_EMV3DS_CRES, $_POST["cres"]);

		$service = new RESTAuthenticationRequestService($redsysController->get_clave256(), $redsysController->get_entorno());
		$result = $service->sendOperation($request, $idLog);

		$respuestaSIS = RedsysLibrary::checkRespuestaSIS($result->getApiCode(), $result->getAuthCode());

		if ($result->getResult() == RESTConstants::$RESP_LITERAL_OK) {
			$reference = $result->getOperation()->getMerchantIdentifier();
			if ($reference != null && $redsysController->get_customerId()) {
				$cardNumber = $result->getOperation()->getCardNumber();
				$brand = $result->getOperation()->getCardBrand();
				$cardType = $result->getOperation()->getCardType();
				$redsysController->get_reference()->saveReference($redsysController->get_customerId(), $reference, $cardNumber, $brand, $cardType);
			}
			$urlTienda = $redsysController->get_baseURL() . 'redsys/checkout/success';
			$pedido = $result->getOperation()->getOrder();
			OrderManager::SaveOrder($order, $redsysController, $this->get_invoiceService(), $this->get_invoiceSender(), $pedido, $idLog, $respuestaSIS[0]);
		}

		$form = '<p style="font-family: Arial; font-size: 16; font-weight: bold; color: black; align: center;">
					Procesando operaci&oacute;n...
				</p>
				<script>
					window.top.top.location.href="' . $urlTienda . '";
				</script>';

		die($form);
	}
}
