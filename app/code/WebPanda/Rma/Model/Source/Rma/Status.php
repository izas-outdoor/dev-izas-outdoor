<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\Source\Rma;

use WebPanda\Rma\Model\ResourceModel\Status\CollectionFactory as StatusCollectionFactory;

/**
 * Class Status
 * @package WebPanda\Rma\Model\Source\Rma
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    const PENDING_APPROVAL   = 1;
    const APPROVED           = 2;
    const CANCELED           = 3;
    const PACKAGE_SENT       = 4;
    const PACKAGE_RECEIVED   = 5;
    const ISSUED_REFUND      = 6;
    const COMPLETE           = 7;

    const DELETED_STATUS_DEFAULT_STEP = 1;

    /**
     * @var null|array
     */
    protected $options = null;

    /**
     * @var null|array
     */
    protected $optionArray = null;

    /**
     * @var StatusCollectionFactory
     */
    protected $statusCollectionFactory;

    /**
     * Status constructor.
     * @param StatusCollectionFactory $statusCollectionFactory
     */
    public function __construct(
        StatusCollectionFactory $statusCollectionFactory
    ) {
        $this->statusCollectionFactory = $statusCollectionFactory;
    }

    public static function getCoreStatuses()
    {
        return [
            self::PENDING_APPROVAL,
            self::APPROVED,
            self::CANCELED,
            self::PACKAGE_SENT,
            self::PACKAGE_RECEIVED,
            self::ISSUED_REFUND,
            self::COMPLETE
        ];
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->optionArray === null) {
            $this->optionArray = [];
            foreach ($this->getOptions() as $value => $label) {
                $this->optionArray[] = ['value' => $value, 'label' => $label];
            }
        }
        return $this->optionArray;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        if ($this->options === null) {
            $statusCollection = $this->statusCollectionFactory->create();
            foreach ($statusCollection->getItems() as $status) {
                $this->options[$status->getId()] = $status->getName();
            }
        }
        return $this->options;
    }

    /**
     * @param int $value
     * @return null
     */
    public function getOptionByValue($value)
    {
        $options = $this->getOptions();
        if (array_key_exists($value, $options)) {
            return $options[$value];
        }
        return null;
    }

    /**
     * @return array
     */
    public function getStepOptions()
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5
        ];
    }
}
