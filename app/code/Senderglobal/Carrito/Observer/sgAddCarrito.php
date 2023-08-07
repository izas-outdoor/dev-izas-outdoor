<?php
namespace Senderglobal\Carrito\Observer;

use Magento\Framework\Event\ObserverInterface;

class sgAddCarrito implements ObserverInterface
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
		$plantilla = "1";

		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$getLocale = $objectManager->get('Magento\Framework\Locale\Resolver');
		$haystack  = $getLocale->getLocale();
		$source = strtoupper(strstr($haystack, '_', true));

		$customerData = $this->customerSession->getCustomer();
		$customerEmail = $customerData->getEmail();
		$customerName = $customerData->getName();

		if(!empty($customerEmail))
		{
			$producto = $observer->getEvent()->getProduct();

			$nombreProducto = str_replace('"', '\"', $producto->getName());
			$urlProducto = $producto->getProductUrl();
			$precioProducto = number_format($producto->getPrice(), 2);
			$precioFinalProducto = number_format($producto->getFinalPrice(), 2);
			$descripcionProducto = "";

			//$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			//$actual_link = explode("checkout", $actual_link);

			//$imagenProducto = $actual_link[0]."pub/media/catalog/product".$producto->getThumbnail();
			
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";

			$imagenProducto = $actual_link."/pub/media/catalog/product".$producto->getThumbnail();

			$dataCarrito = base64_encode(json_encode(array("parametros" => array("nombre" => $customerName), "productos" => array(array("name" => $nombreProducto, "url" => $urlProducto, "price" => $precioProducto, "finalprice" => $precioFinalProducto, "img" => $imagenProducto, "desc" => $descripcionProducto))), JSON_UNESCAPED_UNICODE));

			$urlAPI = "http://webapp.senderglobal.com/app/APIS/carrito_abandonado/pasarela_magento.php?user_api=$usernameAPI&pwd_api=$passwordAPI&base_code=$basecodeAPI&to=$customerEmail&plantilla=$plantilla&source=$source&data=$dataCarrito";

			file_get_contents($urlAPI);
		}
    }
}