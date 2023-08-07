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
namespace Redsys\Redsys\Controller;

use Redsys\Redsys\Model\RedsysInsiteModel;
use Magento\Store\Model\StoreManagerInterface;

use Magento\Customer\Model\Session;
use Redsys\Redsys\Helper\Reference;
use Redsys\Redsys\Helper\CurrencyManager;

use Magento\Framework\Filesystem\DirectoryList;
use Redsys\Redsys\Helper\RedsysLibrary;

use Magento\Framework\Data\Form\FormKey;

class RedsysInsiteController extends \Magento\Framework\App\Action\Action {
	protected $_baseURL;
	protected $_entorno;
	protected $_nombre;
	protected $_num;
	protected $_terminal;
	protected $_clave256;
	protected $_logactivo;
	protected $_errorpago;
	protected $_tipopago;
    protected $_moneda;
	protected $_genpedido;
	protected $_trans;
	protected $_estado;
	protected $_3ds;
	protected $_ref;
	protected $_text_btn;
	protected $_style_btn;
	protected $_style_body;
	protected $_style_form;
	protected $_style_text;
	protected $_correo;
	protected $_mensaje;
	protected $_customerId;
	protected $_reference;
	protected $_formKey;

	public function __construct(
			RedsysInsiteModel $model,
			StoreManagerInterface $storeManager,
			Session $session,
			Reference $reference,
			DirectoryList $dir, 
			FormKey $formKey) {
		$this->_baseURL = $storeManager->getStore()->getBaseUrl();

		$this->_entorno = $model->getConfigData('entorno');
		$this->_nombre = $model->getConfigData('nombre');
		$this->_num = $model->getConfigData('num');
		$this->_terminal = $model->getConfigData('terminal');
		$this->_clave256 = $model->getConfigData('clave256');
		$this->_tipopago = $model->getConfigData('tipopago');
		$this->_moneda = CurrencyManager::GetCurrency();
		$this->_logactivo = $model->getConfigData('logactivo');
		$this->_errorpago = $model->getConfigData('errorpago');
		$this->_genpedido = $model->getConfigData('genpedido');
		$this->_trans = $model->getConfigData('trans');
		$this->_estado = $model->getConfigData('estado');
		$this->_activar3ds = $model->getConfigData('activar3ds');
		$this->_ref = $model->getConfigData('ref');
		$this->_text_btn = $model->getConfigData('text_btn');
		$this->_style_btn = $model->getConfigData('style_btn');
		$this->_style_body = $model->getConfigData('style_body');
		$this->_style_form = $model->getConfigData('style_form');
		$this->_style_text = $model->getConfigData('style_text');
		$this->_correo = $model->getConfigData('correo');
		$this->_mensaje = $model->getConfigData('mensaje');

		$this->_customerId = $session->isLoggedIn() ? $session->getId() : null;
		$this->_reference = $reference;

		$this->_formKey = $formKey;
	}

	public function get_baseURL() {
		return $this->_baseURL;
	}

	public function get_entorno() {
		return $this->_entorno;
	}

	public function get_nombre() {
		return $this->_nombre;
	}

	public function get_num() {
		return $this->_num;
	}

	public function get_terminal() {
		return $this->_terminal;
	}

	public function get_clave256() {
		return $this->_clave256;
	}

	public function get_tipopago() {
		return $this->_tipopago;
	}

	public function get_moneda() {
		return $this->_moneda;
	}

	public function get_logactivo() {
		return $this->_logactivo;
	}

	public function get_errorpago() {
		return $this->_errorpago;
	}

	public function get_genpedido() {
		return $this->_genpedido;
	}

	public function get_trans() {
		return $this->_trans;
	}

	public function get_estado() {
		return $this->_estado;
	}

	public function get_activar3ds() {
		return $this->_activar3ds;
	}

	public function get_ref() {
		return $this->_ref;
	}

	public function get_text_btn() {
		return $this->_text_btn;
	}

	public function get_style_btn() {
		return $this->_style_btn;
	}

	public function get_style_body() {
		return $this->_style_body;
	}

	public function get_style_form() {
		return $this->_style_form;
	}

	public function get_style_text() {
		return $this->_style_text;
	}

	public function get_correo() {
		return $this->_correo;
	}

	public function get_mensaje() {
		return $this->_mensaje;
	}

	public function get_customerId() {
		return $this->_customerId;
	}

	public function get_reference() {
		return $this->_reference;
	}

	public function get_formKey() {
		return $this->_formKey;
	}

	public function execute(){
		die();
	}

	public static function createEndpointParams($endpoint, $object, $idCart, $protocolVersion = null, $idLog = null) {

//		$symbol = empty(count($_GET)) ? '&' : '?';

		$endpoint .= "?order=".$object->getOrder();
		$endpoint .= "&currency=".$object -> getCurrency();
		$endpoint .= "&amount=".$object -> getAmount();
		$endpoint .= "&merchant=".$object -> getMerchant();
		$endpoint .= "&terminal=".$object -> getTerminal();
		$endpoint .= "&transactionType=".$object -> getTransactionType();
		$endpoint .= "&idCart=".$idCart;
	   
		if (!empty($protocolVersion))
			$endpoint .= "&protocolVersion=".$protocolVersion;
		
		if (!empty($idLog))
			$endpoint .= "&idLog=".$idLog;
	   
		return $endpoint;
	}

	function createMerchantData($moduleComent, $idCart) {

        $data = (object) [
            'moduleComent' => $moduleComent,
            'idCart' => $idCart
        ];
        
        return json_encode($data);
       
    }
}


?>