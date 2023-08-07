<?php
/**
 * Copyright © 2015 Seonov. All rights reserved.
 */
namespace Seonov\Slider\Model\ResourceModel;

/**
 * Seonovslider resource
 */
class Seonovslider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('slider_seonovslider', 'id');
    }

  
}
