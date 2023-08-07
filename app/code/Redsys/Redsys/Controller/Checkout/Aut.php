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
use Redsys\Redsys\Controller\RedsysInsiteController;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;

class Aut extends \Magento\Framework\App\Action\Action implements \Magento\Framework\App\CsrfAwareActionInterface
{
	protected $_session;
	protected $_redsysController;

	public function __construct(
		Context $context,
		Session $session,
		RedsysInsiteController $redsysController
	) {

		$this->_session = $session;
		$this->_redsysController = $redsysController;


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
	public function execute()
	{
		$session = $this->get_session();
		$redsysController = $this->get_redsysController();

		$form = '<iframe name="redsys_iframe_acs" name="redsys_iframe_acs" src=""
	    		id="redsys_iframe_acs"
	    		sandbox="allow-same-origin allow-scripts allow-top-navigation allow-forms"
	    		height="95%" width="100%" style="border: black; border-width: thick; position: relative; display: none; z-index: 999;"></iframe>
	    	
    	<form name="redsysAcsForm" id="redsysAcsForm"
    		action="' . $session->getData('REDSYS_urlacs') . '" method="POST"
    		target="redsys_iframe_acs" style="border: none;">
    		<table name="dataTable" border="0" cellpadding="0">
				<input type="hidden" name="TermUrl"
					value="' . $session->getData('REDSYS_termurl') . '">

				';
		if ($session->getData('REDSYS_pareq')) {
			$form .= '
				<input type="hidden" name="PaReq"
					value="' . $session->getData('REDSYS_pareq') . '">
			';
		}
		if ($session->getData('REDSYS_md')) {
			$form .= '
				<input type="hidden" name="MD"
					value="' . $session->getData('REDSYS_md') . '">
			';
		}
		if ($session->getData('REDSYS_creq')) {
			$form .= '
				<input type="hidden" name="creq"
					value="' . $session->getData('REDSYS_creq') . '">
			';
		}
		$form .= '
    			<br>
    			<p
    				style="font-family: Arial; font-size: 16; font-weight: bold; color: black; align: center;">
    				Conectando con el emisor...</p>
    		</table>
    	</form>
	    	
    	<script>
			document.body.style.margin = "0px";
			
    		window.onload = function () {
				
    		    document.getElementById("redsys_iframe_acs").onload = function() {
    		    	document.getElementById("redsysAcsForm").style.display="none";
    		    	document.getElementById("redsys_iframe_acs").style.display="inline";
    		    }
				document.redsysAcsForm.submit();
    		}
		</script>';

		die($form);
	}
}
