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
use Magento\Framework\View\Result\PageFactory;
use Magento\Checkout\Model\Session;
use Magento\Store\Model\StoreManagerInterface; 
use Redsys\Redsys\Controller\RedsysInsiteController;
use Redsys\Redsys\Helper\Constants\RESTConstants;

use Redsys\Redsys\Helper\RedsysLibrary;

class Paymentform extends \Magento\Framework\App\Action\Action {
	protected $_session;
	protected $_resultPageFactory;
	protected $_storeManager;
	protected $_redsysController;

	public function __construct(Context $context, PageFactory $resultPageFactory, Session $session, StoreManagerInterface $storeManager, RedsysInsiteController $redsysController) {
		$this->_session = $session;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_storeManager = $storeManager;
		$this->_redsysController = $redsysController;
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

	public function get_session() {
		return $this->_session;
	}

	public function get_resultPageFactory() {
		return $this->_resultPageFactory;
	}

	public function get_storeManager() {
		return $this->_storeManager;
	}

	public function get_redsysController() {
		return $this->_redsysController;
	}

	public function execute() {
		$session = $this->get_session();
		$resultPageFactory = $this->get_resultPageFactory();
		$redsysController = $this->get_redsysController();

		$order = $session->getLastRealOrder();
		
		$allowReference = $redsysController->get_ref();
		$bodyStyle = $redsysController->get_style_body();
		$formStyle = $redsysController->get_style_form();
		$formTextStyle = $redsysController->get_style_text();
		$btnStyle = $redsysController->get_style_btn();
		$btnText = $redsysController->get_text_btn();
		$entorno = $redsysController->get_entorno();
		$urlTienda = $redsysController->get_baseURL() . 'redsys/checkout/';
		$formKeyParam = '?form_key=' . $redsysController->get_formKey()->getFormKey();

		$numpedido = RedsysLibrary::generaNumeroPedido($order->getId(), $redsysController->get_genpedido());


		$redsysJS = RESTConstants::getJSPath($entorno);
		
		$ref = $redsysController->get_reference()->getCustomerRef($redsysController->get_customerId());
		$brandImg = "";
		$showBrand = false;
		$refTitle = "";
		if ($allowReference) {
			if ($ref != null) {
				$refTitle = "Usar tarjeta de " . ($ref[3] == "C" ? "cr&eacute;dito" : "d&eacute;bito") . " guardada ";
				if ($ref[1] != null)
					$refTitle .= $ref[1];
				if ($ref[2] != null){
					$brandImg = $ref[2] . ".jpg";
					$showBrand = true;
				}
			}
		}

		$resultPage = $resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend(__("Pago con tarjeta - Redsys")); //Nombre del método de pago
		$resultPage->getLayout()->initMessages();
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setMerchantCode($redsysController->get_num());
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setMerchantTerminal($redsysController->get_terminal());
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setRedsysJS($redsysJS);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setNumPed($numpedido);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setIdCart($order->getId());
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setAllowReference($allowReference);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setDisplayReference($allowReference ? "" : "display:none;");
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setDisplayRadios($allowReference && $ref != null? "" : "display:none;");
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setReferenceTitle($refTitle);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setShowCardBrandLogo($showBrand);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setCardBrandLogo($brandImg);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setProcURL($urlTienda . 'pay' . $formKeyParam);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setProcURLRef($urlTienda . 'ref' . $formKeyParam);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setBodyStyle($bodyStyle);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setFormStyle($formStyle);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setFormTextStyle($formTextStyle);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setBtnStyle($btnStyle);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setBtnText($btnText);
		$resultPage->getLayout()->getBlock('redsys_checkout_paymentform')->setURLKo($urlTienda . 'error' . $formKeyParam);
		return $resultPage;
	}
}