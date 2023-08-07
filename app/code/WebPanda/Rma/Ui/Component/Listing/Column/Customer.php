<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\CustomerFactory;

/**
 * Class Customer
 * @package WebPanda\Rma\Ui\Component\Listing\Column
 */
class Customer extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * Customer constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $url
     * @param CustomerFactory $customerFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $url,
        CustomerFactory $customerFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
        $this->url = $url;
        $this->customerFactory = $customerFactory;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item[$fieldName]) {
                    $customerId = $item[$fieldName];
                    $customer = $this->customerFactory->create()->load($customerId);
                    if ($customer->getId()) {
                        $item[$fieldName . '_text'] = $item['customer_name'] . "</br>" . $customer->getEmail();
                        $item[$fieldName . '_url'] = $this->url->getUrl(
                            'customer/index/edit',
                            ['id' => $customer->getId()]
                        );
                    } else {
                        $item[$fieldName . '_text'] = $item['customer_name'];
                    }
                } else {
                    $item[$fieldName . '_text'] = $item['customer_name'];
                }
            }
        }

        return $dataSource;
    }
}
