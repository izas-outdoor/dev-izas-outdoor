<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Customer\Rma\View;

use WebPanda\Rma\Model\Source\Rma\Status as StatusSource;

/**
 * Class Actions
 * @package WebPanda\Rma\Block\Customer\Rma\View
 */
class Actions extends \WebPanda\Rma\Block\Customer\Rma\View
{
    private $statusesForCustomerCantCancel = [
        StatusSource::CANCELED,
        StatusSource::PACKAGE_SENT,
        StatusSource::PACKAGE_RECEIVED,
        StatusSource::ISSUED_REFUND,
        StatusSource::COMPLETE
    ];

    private $statusesForCantPrintPackingSlip = [
        StatusSource::PENDING_APPROVAL,
        StatusSource::CANCELED,
        StatusSource::PACKAGE_SENT,
        StatusSource::PACKAGE_RECEIVED,
        StatusSource::ISSUED_REFUND,
        StatusSource::COMPLETE
    ];

    private $statusesForCantConfirmShipping = [
        StatusSource::PENDING_APPROVAL,
        StatusSource::CANCELED,
        StatusSource::PACKAGE_SENT,
        StatusSource::PACKAGE_RECEIVED,
        StatusSource::ISSUED_REFUND,
        StatusSource::COMPLETE
    ];

    /**
     * @return bool
     */
    public function canCancel()
    {
        return !in_array($this->getRmaModel()->getStatusId(), $this->statusesForCustomerCantCancel);
    }

    /**
     * @return bool
     */
    public function canPrintPackingSlip()
    {
        return !in_array($this->getRmaModel()->getStatusId(), $this->statusesForCantPrintPackingSlip);
    }

    /**
     * @return bool
     */
    public function canConfirmShipping()
    {
        return !in_array($this->getRmaModel()->getStatusId(), $this->statusesForCantConfirmShipping);
    }

    /**
     * @return string
     */
    public function getConfirmShippingPopupText()
    {
        return $this->configHelper->getConfirmShipmentPopupText();
    }

    /**
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->getUrl('*/*/cancel', ['id' => $this->getRmaModel()->getId()]);
    }

    /**
     * @return string
     */
    public function getPrintPackingSlipUrl()
    {
        return $this->getUrl('*/*/printPackingSlip', ['id' => $this->getRmaModel()->getId()]);
    }

    /**
     * @return string
     */
    public function getConfirmShipping()
    {
        return $this->getUrl('*/*/confirmShipping', ['id' => $this->getRmaModel()->getId()]);
    }
}
