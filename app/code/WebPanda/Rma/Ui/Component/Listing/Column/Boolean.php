<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Ui\Component\Listing\Column;

/**
 * Class Boolean
 * @package WebPanda\Rma\Ui\Component\Listing\Columns
 */
class Boolean extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items']))
        {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item[$fieldName])) {
                    if( $item[$fieldName] == 0 ) {
                        $item[$fieldName] = strval(__("No"));
                    }

                    if( $item[$fieldName] == 1 ) {
                        $item[$fieldName] = strval(__("Yes"));
                    }
                }
            }
        }

        return $dataSource;
    }
}
