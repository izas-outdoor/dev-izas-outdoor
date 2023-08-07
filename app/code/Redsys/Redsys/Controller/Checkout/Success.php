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

use Magento\Framework\Filesystem\DirectoryList;


class Success extends \Magento\Framework\App\Action\Action {
	protected $_session;
	protected $_resultPageFactory;
	protected $_storeManager;
	protected $_redsysController;
	protected $_dir;

	public function __construct(Context $context, PageFactory $resultPageFactory, Session $session, StoreManagerInterface $storeManager, DirectoryList $dir, RedsysInsiteController $redsysController) {
		$this->_session = $session;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_storeManager = $storeManager;
		$this->_redsysController = $redsysController;
		$this->_dir = $dir;
		return parent::__construct($context);
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
		$resultPageFactory = $this->get_resultPageFactory();

		$resultPage = $resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend(__("Gracias por su compra"));
		$resultPage->getLayout()->initMessages();
		$resultPage->getLayout()->getBlock("redsys_checkout_success")->setMessage("Gracias por confiar en nosotros. El pago del pedido ha sido procesado con &eacute;xito.");
		return $resultPage;
	}
}