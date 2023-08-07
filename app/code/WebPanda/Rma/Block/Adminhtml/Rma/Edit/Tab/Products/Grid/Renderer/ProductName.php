<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer;

use Magento\Framework\UrlInterface;

/**
 * Class ProductName
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer
 */
class ProductName extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * ProductName constructor.
     * @param \Magento\Backend\Block\Context $context
     * @param UrlInterface $url
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        UrlInterface $url,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->url = $url;
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        if (!$row->getProductId()) {
            return $row->getName();
        }
        $url = $this->url->getUrl(
            'catalog/product/edit',
            ['id' => $row->getProductId()]
        );

        return '<a href="' . $url . '" target="_blank">' . $row->getName() . '</a>';
    }
}
