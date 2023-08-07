<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Guest\Rma;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Registry;
use WebPanda\Rma\Helper\Config;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Catalog\Block\Product\ImageBuilder;

/**
 * Class View
 * @package WebPanda\Rma\Block\Guest\Rma
 */
class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var BlockRepositoryInterface
     */
    protected $blockRepository;

    /**
     * @var ImageBuilder
     */
    protected $imageBuilder;

    /**
     * @var array
     */
    protected $products = [];

    /**
     * View constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ProductFactory $productFactory
     * @param Config $configHelper
     * @param BlockRepositoryInterface $blockRepository
     * @param ImageBuilder $imageBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProductFactory $productFactory,
        Config $configHelper,
        BlockRepositoryInterface $blockRepository,
        ImageBuilder $imageBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->coreRegistry = $coreRegistry;
        $this->productFactory = $productFactory;
        $this->configHelper = $configHelper;
        $this->blockRepository = $blockRepository;
        $this->imageBuilder = $imageBuilder;
    }

    /**
     * @return \WebPanda\Rma\Model\Rma
     */
    public function getRmaModel()
    {
        return $this->coreRegistry->registry('rma_request');
    }

    /**
     * @param int $productId
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct($productId)
    {
        if (!isset($this->products[$productId])) {
            $this->products[$productId] = $this->productFactory->create()->load($productId);
        }
        return $this->products[$productId];
    }

    /**
     * @param $productId
     * @return bool
     */
    public function getProductExists($productId)
    {
        if (
            $this->getProduct($productId)->getId() &&
            $this->getProduct($productId)->getStatus() == \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getOrderUrl($orderId)
    {
        return $this->getUrl('sales/order/view', ['order_id' => $orderId]);
    }

    /**
     * @param $rmaItem
     * @return string
     */
    public function getProductUrl($rmaItem)
    {
        $product = $this->getProduct($rmaItem->getProductId());
        $parentProductId = $rmaItem->getParentProductId();
        if ($parentProductId) {
            $parentProduct = $this->getProduct($parentProductId);
            return $parentProduct->getProductUrl();
        }

        return $product->getProductUrl();
    }

    /**
     * @return string
     */
    public function getRmaUpdateUrl()
    {
        return $this->getUrl('rma/guest/update');
    }

    /**
     * @return string
     */
    public function getRmaDepartmentAddress()
    {
        return $this->configHelper->getRmaDepartmentAddress();
    }

    /**
     * @return bool
     */
    public function canEditResolution()
    {
        return $this->configHelper->canCustomerEditResolution($this->getRmaModel()->getStatusId());
    }

    /**
     * @return string
     */
    public function getResolutionLabel()
    {
        return $this->configHelper->getResolutionFrontendLabel();
    }

    /**
     * @return array
     */
    public function getResolutionOptions()
    {
        return $this->configHelper->getResolutionOptions();
    }

    /**
     * @return bool
     */
    public function canEditItemCondition()
    {
        return $this->configHelper->canCustomerEditItemCondition($this->getRmaModel()->getStatusId());
    }

    /**
     * @return string
     */
    public function getItemConditionLabel()
    {
        return $this->configHelper->getItemConditionFrontendLabel();
    }

    /**
     * @return array
     */
    public function getItemConditionOptions()
    {
        return $this->configHelper->getItemConditionOptions();
    }

    /**
     * @return bool
     */
    public function canEditReason()
    {
        return $this->configHelper->canCustomerEditReason($this->getRmaModel()->getStatusId());
    }

    /**
     * @return string
     */
    public function getReasonLabel()
    {
        return $this->configHelper->getReasonFrontendLabel();
    }

    /**
     * @return array
     */
    public function getReasonOptions()
    {
        return $this->configHelper->getReasonOptions();
    }

    /**
     * @return string
     */
    public function getSpecialStyle()
    {
        return $this->configHelper->getSpecialStyle();
    }

    /**
     * @return mixed
     */
    public function getActiveStep()
    {
        if ($this->getRmaModel()->getStatus()) {
            return $this->getRmaModel()->getStatus()->getStep() + 1;
        }

        return \WebPanda\Rma\Model\Source\Rma\Status::DELETED_STATUS_DEFAULT_STEP;
    }

    /**
     * @return null|string
     */
    public function getReturnInstructions()
    {
        $blockId = $this->configHelper->getReturnInstructionsBlock();
        $block = $this->blockRepository->getById($blockId);

        return $block->getContent();
    }

    /**
     * Retrieve product image
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @param array $attributes
     * @return \Magento\Catalog\Block\Product\Image
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        return $this->imageBuilder->setProduct($product)
            ->setImageId($imageId)
            ->setAttributes($attributes)
            ->create();
    }
}
