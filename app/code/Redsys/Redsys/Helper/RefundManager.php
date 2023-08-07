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

namespace Redsys\Redsys\Helper;

use Redsys\Redsys\Helper\Model\message\RESTOperationMessage;
use Redsys\Redsys\Helper\Service\Impl\RESTOperationService;
use Redsys\Redsys\Helper\Constants\RESTConstants;

use Redsys\Redsys\Helper\CurrencyManager;

class RefundManager {
	public static function Refund($gateway, $orderId, $amount, $reason = '', $idLog = null) {
		$amount = CurrencyManager::GetAmount($amount, $gateway['moneda']);

		$request = new RestOperationMessage();
        
		$request->setAmount( $amount );
		$request->setCurrency( CurrencyManager::CurrencyCode($gateway['moneda']) );
		$request->setMerchant( $gateway['fuc'] );
		$request->setTerminal( $gateway['terminal'] );
		$request->setOrder( $orderId );
		$request->setTransactionType( RESTConstants::$REFUND );
		$request->addParameter( "DS_MERCHANT_PRODUCTDESCRIPTION", $reason );

        RedsysLibrary::escribirLog("DEBUG", $idLog, "Se inicia una devolucion con los siguientes parametros:");
        RedsysLibrary::escribirLog("DEBUG", $idLog, "  Monto: " . $amount);
        RedsysLibrary::escribirLog("DEBUG", $idLog, "  Moneda: " . $gateway['moneda']);
        RedsysLibrary::escribirLog("DEBUG", $idLog, "  Comercio: " . $gateway['fuc']);
        RedsysLibrary::escribirLog("DEBUG", $idLog, "  Terminal: " . $gateway['terminal']);
        RedsysLibrary::escribirLog("DEBUG", $idLog, "  Orden: " . $orderId);

    	$service = new RESTOperationService ( $gateway['clave256'], $gateway['entorno'] );
    	$result = $service->sendOperation ( $request );

        if($result->getResult () == RESTConstants::$RESP_LITERAL_OK){
            RedsysLibrary::escribirLog("DEBUG", $idLog, "La devolucion se realizo correctamente");
        }else{
            RedsysLibrary::escribirLog("DEBUG", $idLog, "La devolucion no se realizo correctamente");
        }

		return $result->getResult () == RESTConstants::$RESP_LITERAL_OK;
	}
}