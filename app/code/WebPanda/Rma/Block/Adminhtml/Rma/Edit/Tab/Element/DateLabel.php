<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element;

/**
 * Class DateLabel
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element
 */
class DateLabel extends \Magento\Framework\Data\Form\Element\Date
{
    /**
     * Output the input field and assign calendar instance to it.
     * In order to output the date:
     * - the value must be instantiated (\DateTime)
     * - output format must be set (compatible with \DateTime)
     *
     * @throws \Exception
     * @return string
     */
    public function getElementHtml()
    {
        $this->addClass('admin__control-text input-text input-date');
        $dateFormat = $this->getDateFormat() ?: $this->getFormat();
        $timeFormat = $this->getTimeFormat();
        if (empty($dateFormat)) {
            throw new \Exception(
                'Output format is not specified. ' .
                'Please specify "format" key in constructor, or set it using setFormat().'
            );
        }

        $dataInit = 'data-mage-init="' . $this->_escape(
                json_encode(
                    [
                        'calendar' => [
                            'dateFormat' => $dateFormat,
                            'showsTime' => !empty($timeFormat),
                            'timeFormat' => $timeFormat,
                            'buttonImage' => $this->getImage(),
                            'buttonText' => 'Select Date',
                            'disabled' => $this->getDisabled(),
                            'minDate' => $this->getMinDate(),
                            'maxDate' => $this->getMaxDate(),
                        ],
                    ]
                )
            ) . '"';

        $html = sprintf(
            '<div class="control-value">%s</div>',
            $this->_escape($this->getValue())
        );
        $html .= $this->getAfterElementHtml();
        return $html;
    }
}
