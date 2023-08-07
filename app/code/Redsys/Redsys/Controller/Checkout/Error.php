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

use Redsys\Redsys\Controller\RedsysInsiteController;
use Redsys\Redsys\Helper\OrderManager;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Checkout\Model\Session;
use Magento\Store\Model\StoreManagerInterface; 
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Model\Cart;

class Error extends  \Magento\Framework\App\Action\Action {
	protected $_session;
	protected $_resultPageFactory;
	protected $_storeManager;
	protected $_redsysController;
	protected $_productRepository;
	protected $_cart;

	public function __construct(
			Context $context, 
			PageFactory $resultPageFactory, 
			Session $session, 
			StoreManagerInterface $storeManager, 
			RedsysInsiteController $redsysController, 
			ProductRepository $productRepository, 
			Cart $cart) {
		
		$this->_session = $session;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_storeManager = $storeManager;
		$this->_redsysController = $redsysController;
		$this->_productRepository = $productRepository;
		$this->_cart = $cart;

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

	public function get_productRepository() {
		return $this->_productRepository;
	}

	public function get_cart() {
		return $this->_cart;
	}

	public function execute() {
		$session = $this->get_session();
		$resultPageFactory = $this->get_resultPageFactory();
		$redsysController = $this->get_redsysController();
		
		$order = $session->getLastRealOrder();
		$cart = $this->get_cart();
		$formKey = $redsysController->get_formKey()->getFormKey();
		$productRepository = $this->get_productRepository();

		$saveCart = $redsysController->get_errorpago();

		if (!isset($_GET['form_key'])){
			$estado = 0;
		}
		elseif ($saveCart) {
			$estado = 1;
			OrderManager::RestoreCart($order, $cart, $formKey, $productRepository);
		}
		else{
			$estado = 2;
		}

		$resultPage = $resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend("Error procesando el pago");
		$resultPage->getLayout()->initMessages();
		$resultPage->getLayout()->getBlock('redsys_checkout_error')->setEstado($estado);
		return $resultPage;
	}
}
