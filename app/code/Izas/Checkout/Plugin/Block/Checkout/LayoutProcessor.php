<?php
namespace Izas\Checkout\Plugin\Block\Checkout;

/**
 * Class LayoutProcessor
 * @package Izas\Checkout\Plugin\Block\Checkout
 */
class LayoutProcessor extends \Wetrust\Checkout\Plugin\Block\Checkout\LayoutProcessor
{
    protected function removeBillingAddress($jsLayout)
    {
        $paymentsList = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']
        ['children']['payment']['children']['payments-list']['children'];

        foreach ($paymentsList as $key => $config) {
            if ($key != 'before-place-order') {
                unset($paymentsList[$key]);
            }
        }

        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']
        ['children']['payments-list']['children'] = $paymentsList;

        return $jsLayout;
    }
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout = $this->removeBillingAddress($jsLayout);
        return $this->setJsLayout($jsLayout)->processLayout();
    }
}
