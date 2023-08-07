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
namespace Redsys\Redsys\Model;

use Redsys\Redsys\Helper\RefundManager;
use Redsys\Redsys\Helper\CurrencyManager;
use Redsys\Redsys\Helper\RedsysLibrary;

/**
 * Gateway payment method model
 */
class RedsysInsiteModel extends \Magento\Payment\Model\Method\AbstractMethod
{

    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'redsys_insite';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = false;
    
    protected $_isGateway = true;

    protected $_canRefund = true;
    
    public function getConfigData($field, $storeId=null){
    	return parent::getConfigData($field, $storeId);
    }

    function getTitle(){
    	return __(parent::getTitle());
    }

    public function refund($payment, $amount){
        $order = $payment->getOrder();
        $invoice = $order->getInvoiceCollection()->getFirstItem();

        $orderId = $invoice->getTransactionId();
        $reason = '';

        $gateway = array(
            'moneda' => CurrencyManager::GetCurrency(),
            'fuc' => $this->getConfigData('num'),
            'terminal' => $this->getConfigData('terminal'),
            'clave256' => $this->getConfigData('clave256'),
            'entorno' => $this->getConfigData('entorno'),
        );

        $idLog = RedsysLibrary::generateIdLog($this->getConfigData('logactivo'), $orderId);

		if(!RefundManager::Refund($gateway, $orderId, $amount, '', $idLog)){
            throw new \Exception('Error al realizar una devolución');
        }

        return parent::refund($payment, $amount);
    }
}
