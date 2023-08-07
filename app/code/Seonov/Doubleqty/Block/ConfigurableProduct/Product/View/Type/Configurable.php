<?php
namespace Seonov\Doubleqty\Block\ConfigurableProduct\Product\View\Type;

use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Json\DecoderInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Psr\Log\LoggerInterface;

class Configurable
{

    protected $jsonEncoder;
    protected $jsonDecoder;
    protected $stockRegistry;

    public function __construct(
        EncoderInterface $jsonEncoder,
        DecoderInterface $jsonDecoder,
        StockRegistryInterface $stockRegistry,
        LoggerInterface $logger
    )
    {

        $this->jsonDecoder = $jsonDecoder;
        $this->jsonEncoder = $jsonEncoder;
        $this->stockRegistry = $stockRegistry;
        $this->logger = $logger;
    }

    // Adding Quantitites (product=>qty)
    public function aroundGetJsonConfig(
        \Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject,
        \Closure $proceed
    )
    {
        $quantities = [];
        $squantities = [];
        $config = $proceed();
        $config = $this->jsonDecoder->decode($config);
        $testsqty = 0;
        $testqty = 0;
        $your_date = 0;
        $shippingtime = array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $StockState = $objectManager->get('\Magento\CatalogInventory\Api\StockStateInterface');

        $allProducts = $subject->getProduct()->getTypeInstance()->getUsedProducts($subject->getProduct(), null);

        foreach ($allProducts as $product) {
            $testsqty = 0;
            $testqty = 0;
            $stockitem = $this->stockRegistry->getStockItem(
                $product->getId(),
                $product->getStore()->getWebsiteId()
            );

            //$qty = $StockState->getStockQty($product->getId(), $product->getStore()->getWebsiteId());
            //$stockItem = $product->getExtensionAttributes()->getStockItem();
            //$qty = $stockItem->getQty();
            //$qty = $StockState->getStockQty($product->getId(), $product->getStore()->getWebsiteId());
            $productrow = $objectManager->create('\Magento\Catalog\Model\Product')->load($product->getId());

            $qty = 0;
            $secondeqty = 0;

            $qty = $stockitem->getQty();


            $shippingtimevariable = array("qty" => $qty, "sqty" => $secondeqty);

            /************************************************************************/

            $shippingtime[$product->getId()] = $shippingtimevariable;
        }

        $config['shippingtime'] = @$shippingtime;
        return $this->jsonEncoder->encode($config);
    }
}

?>
