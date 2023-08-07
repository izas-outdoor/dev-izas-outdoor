<?php

namespace Redsys\Redsys\Helper\Service\Impl;

use Redsys\Redsys\Helper\Service\RESTService;
use Redsys\Redsys\Helper\Model\message\RESTInitialRequestMessage;
use Redsys\Redsys\Helper\Model\message\RESTResponseMessage;
use Redsys\Redsys\Helper\Model\element\RESTOperationElement;
use Redsys\Redsys\Helper\Model\RESTRequestInterface;
use Redsys\Redsys\Helper\Model\RESTRequestIntRESTResponseInterfaceerface;
use Redsys\Redsys\Helper\Utils\RESTSignatureUtils;
use Redsys\Redsys\Helper\Constants\RESTConstants;
use Redsys\Redsys\Helper\RedsysLibrary;

class RESTInitialRequestService extends RESTService{
    function __construct($signatureKey, $env){
        parent::__construct($signatureKey, $env, RESTConstants::$INICIA);
    }
    
    public function createRequestMessage($message){
        $req=new RESTInitialRequestMessage();
        $req->setDatosEntrada($message);
    
        $tagDE=$message->toJson();
        
        $signatureUtils=new RESTSignatureUtils();
        $localSignature=$signatureUtils->createMerchantSignature($this->getSignatureKey(), $req->getDatosEntradaB64());
        $req->setSignature($localSignature);

        return $req;
    }

    public function createResponseMessage($trataPeticionResponse, $idLog){
        $response = $this->unMarshallResponseMessage($trataPeticionResponse);
        
        if (is_null($response->getApiCode())) {

            $paramsB64=json_decode($trataPeticionResponse,true)["Ds_MerchantParameters"];
            $response->setApiCode($response->getOperation()->getResponseCode());
            
            $transType = $response->getTransactionType();
            if(!$this->checkSignature($paramsB64, $response->getOperation()->getSignature(), $idLog))
            {
                RedsysLibrary::escribirLog("ERROR", $idLog, "Se ha producido un error -- Datos recibidos: " . $trataPeticionResponse, null, __METHOD__);
                $response->setResult(RESTConstants::$RESP_LITERAL_KO);
            }
            else{
                if ($response->getOperation()->getResponseCode() == null && $response->getOperation()->getPsd2() != null && $response->getOperation()->getPsd2() == RESTConstants::$RESPONSE_PSD2_TRUE) {
                    $response->setResult(RESTConstants::$RESP_LITERAL_AUT);
                    RedsysLibrary::escribirLog("INFO ", $idLog, "AUT // La operación requiere de autenticación", null, __METHOD__);
                }else if ($response->getOperation()->getResponseCode() == null && $response->getOperation()->getPsd2() != null && $response->getOperation()->getPsd2() == RESTConstants::$RESPONSE_PSD2_FALSE) {
                    $response->setResult(RESTConstants::$RESP_LITERAL_OK);
                    RedsysLibrary::escribirLog("INFO ", $idLog, "OK // La operación ha finalizado correctamente", null, __METHOD__);
                }
                else{
                    $response->setResult(RESTConstants::$RESP_LITERAL_KO);
                    RedsysLibrary::escribirLog("ERROR", $idLog, "KO // La operación ha finalizado con errores", null, __METHOD__);
                }
            }
        }

        RedsysLibrary::escribirLog("DEBUG", $idLog, "Datos recibidos: " . $response->toXml(), null, __METHOD__);		
        return $response;
    }
    
    // public function unMarshallResponseMessage($message){
    // 	$response=new RESTResponseMessage();
        
    // 	$varArray=json_decode($message,true);
        
    // 	$operacion=new RESTOperationElement();
    // 	$operacion->parseJson(base64_decode($varArray["Ds_MerchantParameters"]));
    // 	$operacion->setSignature($varArray["Ds_Signature"]);
        
    // 	$response->setOperation($operacion);
        
    // 	return $response;
    // }
}