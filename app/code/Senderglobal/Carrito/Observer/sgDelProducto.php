<?php
namespace Senderglobal\Carrito\Observer;

use Magento\Framework\Event\ObserverInterface;

class sgDelProducto implements ObserverInterface
{
	protected $customerSession;

	public function __construct(\Magento\Customer\Model\Session $customerSession)
	{
	   $this->customerSession = $customerSession;
    }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$usernameAPI = "izas_API";
		$passwordAPI = "y0fROMr4e5dk0123";
		$basecodeAPI = "056262";

		$customerData = $this->customerSession->getCustomer();
		$customerEmail = $customerData->getEmail();

		if(!empty($customerEmail))
		{
            $producto = $observer->getQuoteItem()->getProduct();

            $urlProducto = base64_encode($producto->getProductUrl());

            $urlAPI = "http://webapp.senderglobal.com/app/APIS/carrito_abandonado/pasarela_magento.php?user_api=$usernameAPI&pwd_api=$passwordAPI&base_code=$basecodeAPI&to=$customerEmail&data=$urlProducto&actiondeleteproduct=true";

            file_get_contents($urlAPI);
		}
    }
}