<?php

namespace Redsys\Redsys\Helper\Service\Impl;

use Redsys\Redsys\Helper\Service\RESTService;
use Redsys\Redsys\Helper\Model\message\RESTInitialRequestMessage;
use Redsys\Redsys\Helper\Model\message\RESTResponseMessage;
use Redsys\Redsys\Helper\Utils\RESTSignatureUtils;
use Redsys\Redsys\Helper\Constants\RESTConstants;

use Redsys\Redsys\Helper\RedsysLibrary;

class RESTAuthenticationRequestService extends RESTService{
	function __construct($signatureKey, $env){
		parent::__construct($signatureKey, $env, RESTConstants::$TRATA);
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
	
	public function createResponseMessage($trataPeticionResponse, $idLog = null){
		$response=$this->unMarshallResponseMessage($trataPeticionResponse);
		if (is_null($response->getApiCode())) {
			$paramsB64=json_decode($trataPeticionResponse,true)["Ds_MerchantParameters"];
			$response->setApiCode($response->getOperation()->getResponseCode());

			if(!empty($response->getOperation()->getAuthCode()))
				$response->setAuthCode($response->getOperation()->getAuthCode());

			$transType = $response->getTransactionType();
			
			if(!$this->checkSignature($paramsB64, $response->getOperation()->getSignature(), $idLog))
			{
				RedsysLibrary::escribirLog("ERROR", $idLog, "Se ha producido un error -- Datos recibidos: " . $trataPeticionResponse, null, __METHOD__);
				$response->setResult(RESTConstants::$RESP_LITERAL_KO);
			}
			else{
				switch ((int)$response->getOperation()->getResponseCode()){
					case RESTConstants::$AUTHORIZATION_OK: $response->setResult(($transType==RESTConstants::$AUTHORIZATION || $transType==RESTConstants::$PREAUTHORIZATION)?RESTConstants::$RESP_LITERAL_OK:RESTConstants::$RESP_LITERAL_KO); break;
					case RESTConstants::$CONFIRMATION_OK: $response->setResult(($transType==RESTConstants::$CONFIRMATION || $transType==RESTConstants::$REFUND)?RESTConstants::$RESP_LITERAL_OK:RESTConstants::$RESP_LITERAL_KO);  break;
					case RESTConstants::$CANCELLATION_OK: $response->setResult($transType==RESTConstants::$CANCELLATION?RESTConstants::$RESP_LITERAL_OK:RESTConstants::$RESP_LITERAL_KO);  break;
					default: $response->setResult(RESTConstants::$RESP_LITERAL_KO);
				}
			}
		}
		RedsysLibrary::escribirLog("DEBUG", $idLog, "Datos recibidos: " . $response->toXml(), null, __METHOD__);
		if($response->getResult()==RESTConstants::$RESP_LITERAL_OK){
			RedsysLibrary::escribirLog("INFO ", $idLog, "OK // La operación ha finalizado correctamente", null, __METHOD__);
		}
		else{
			RedsysLibrary::escribirLog("ERROR", $idLog, "KO // La operación ha finalizado con errores", null, __METHOD__);
		}
		
		return $response;
	}
	
	// public function unMarshallResponseMessage($message){
	// 	$response=new RESTResponseMessage();
		
	// 	$varArray=json_decode($message,true);
	// 	if (array_key_exists ("Ds_MerchantParameters", $varArray) ) {
	// 		$operacion=new RESTOperationElement();
	// 		$operacion->parseJson(base64_decode($varArray["Ds_MerchantParameters"]));
	// 		$operacion->setSignature($varArray["Ds_Signature"]);
			
	// 		$response->setOperation($operacion);
	// 	} else {
	// 		if (array_key_exists ("errorCode", $varArray)) {
	// 			$response->setApiCode($varArray["errorCode"]);
	// 			$response->setResult(RESTConstants::$RESP_LITERAL_KO);
	// 		}
	// 	}
		
	// 	return $response;
	// }
}