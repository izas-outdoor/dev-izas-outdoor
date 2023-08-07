<?php
namespace Senderglobal\Compras\Observer;

use Magento\Framework\Event\ObserverInterface;

class sgRegistrarCompra implements ObserverInterface
{
	protected $sessionManager;

	public function __construct(\Magento\Framework\Session\SessionManagerInterface $sessionManager)
	{	   
	   $this->sessionManager = $sessionManager;
    }
	
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$utm_campaign = $this->sessionManager->getSgCampaign();

		if(isset($utm_campaign) && !empty($utm_campaign))
		{
			$usernameAPI = "izas_API";
			$passwordAPI = "y0fROMr4e5dk0123";
			$basecodeAPI = "598262";

			$email = $observer->getEvent()->getOrder()->getCustomerEmail();
			$total = $observer->getEvent()->getOrder()->getGrandTotal();

			$urlAPI = "http://webapp.senderglobal.com/app/APIS/registrar_compra/api_compra.php?user_api=$usernameAPI&pwd_api=$passwordAPI&base_code=$basecodeAPI&";

			$data = array("email" => $email, "precio" => $total, "utm_campaign" => $utm_campaign);

			$urlFinal = $urlAPI.http_build_query($data);

			file_get_contents($urlFinal);

			$this->sessionManager->unsSgCampaign();
		}
	}
}