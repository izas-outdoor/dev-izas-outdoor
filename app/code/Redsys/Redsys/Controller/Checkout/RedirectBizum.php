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
use Redsys\Redsys\Controller\RedsysBizumController;
use Redsys\Redsys\Helper\CurrencyManager;

class RedirectBizum extends \Magento\Framework\App\Action\Action
{
  	protected $_session;
  	protected $_resultPageFactory;
  	protected $_storeManager;
  	protected $_redsysController;

    public function __construct(Context $context, PageFactory $resultPageFactory, Session $session, StoreManagerInterface $storeManager, RedsysBizumController $redsysController){
	    $this->_session = $session;
	    $this->_resultPageFactory = $resultPageFactory;
    	$this->_storeManager = $storeManager;
    	$this->_redsysController = $redsysController;
    	
	    return parent::__construct($context);
    }
    
    public function execute()
    {
    	$order = $this->_session->getLastRealOrder();
    	$orderId = $order->getId();
    	$noProcesado=(!$this->_session->getData("Redsys".$orderId) || $this->_session->getData("Redsys".$orderId)<10);     	
    	
    	if($orderId && $noProcesado){ 
			$orderItems = $order->getAllItems();
			$amount = CurrencyManager::GetAmount($order->getTotalDue(), $this->_redsysController->get_moneda());
			$cliente = $order->getCustomerFirstname()." ".$order->getCustomerLastname()."/ ".__("Correo").": ".$order->getCustomerEmail();
			$productos = "";
			
	    	foreach($orderItems as $item){
	    		if($item->getQtyOrdered()%1!=0)
	    			$cant=$item->getQtyOrdered();
	    		else
	    			$cant=intval($item->getQtyOrdered());
	    			
				$productos.=$item->getName()."x".$cant." / ";
	    	}

	    	$intento=$this->_session->getData("Redsys".$orderId);
	    	
	    	if($intento==null)
	    		$intento=0;

    		$intento++;    		
    			
	    	$this->_session->setData("Redsys".$orderId, $intento);
    		
    		if($intento==1){
    			$order->setState('new')->setStatus('pending_payment')->save();
    			$order->addStatusHistoryComment(__("Cliente redireccionado a la pasarela de Redsys para pagar mediante Bizum."), false)
	    			->setIsCustomerNotified(false)
	    			->save();
    		}

    		$resultPage = $this->_resultPageFactory->create();
    		$resultPage->getConfig()->getTitle()->prepend(__("Pago con Bizum"));
    		$resultPage->getLayout()->initMessages();
    		$resultPage->getLayout()->getBlock('redsys_checkout_redirectbizum')->setIntento($intento);
    		
    		if($intento<10){    			    	
					    	
		    	$campos=$this->_redsysController->generaCamposFormulario($orderId, $productos, $amount, $cliente);
    		
	    		$resultPage->getLayout()->getBlock('redsys_checkout_redirectbizum')->setEntorno($campos["Entorno"]);
	    		$resultPage->getLayout()->getBlock('redsys_checkout_redirectbizum')->setVersionFirma($campos["Ds_SignatureVersion"]);
	    		$resultPage->getLayout()->getBlock('redsys_checkout_redirectbizum')->setParametros($campos["Ds_MerchantParameters"]);
	    		$resultPage->getLayout()->getBlock('redsys_checkout_redirectbizum')->setFirma($campos["Ds_Signature"]);
    		}
    		
    		return $resultPage;
    	
    	}
    	else 
    		$this->_redirect("checkout");
    }
    
}























