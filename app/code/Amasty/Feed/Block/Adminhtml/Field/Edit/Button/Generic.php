<?php

namespace Amasty\Feed\Block\Adminhtml\Field\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\View\Element\UiComponent\Context;

class Generic implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    private $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * @param string $route
     * @param array $params
     *
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrl($route, $params);
    }

    /**
     * Get current id of record
     *
     * @return int|bool
     */
    public function getCurrentId()
    {
        $params = $this->context->getRequestParams();
        if (isset($params['id'])) {
            return (int)$params['id'];
        } else {
            return false;
        }
    }

    /**
     * Check if the button should be displayed
     *
     * @return bool
     */
    public function isAllowed()
    {
        return is_int($this->getCurrentId());
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonData()
    {
        return [];
    }
}
