<?php
/**
 * Created by Metagento.com
 * Date: 4/18/2019
 */

namespace Metagento\BackendUrlRewrite\Controller\Adminhtml\Product;

class MassGenerate extends \Magento\Catalog\Controller\Adminhtml\Product\MassDelete
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Controller\Adminhtml\Product\Builder $productBuilder,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository = null,
        \Metagento\BackendUrlRewrite\Service\ProductProcess $productProcess
    ) {
        parent::__construct($context, $productBuilder, $filter, $collectionFactory, $productRepository);
        $this->productProcess = $productProcess;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection */
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $productIds = $collection->getAllIds();
        try {
            $this->productProcess->generateProducts($productIds);
            $this->messageManager->addSuccessMessage(__("URL Rewrites have been generated for %1 products",
                count($productIds)));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $result->setUrl($this->_redirect->getRefererUrl());
        return $result;
    }
}