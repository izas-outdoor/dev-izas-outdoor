<?php

/**
 * Product:       Xtento_OrderExport
 * ID:            fso5z3a0QaKnCwcGMUjyKBrw+XWvPsrvsDClR8Fc3jg=
 * Last Modified: 2015-10-11T13:28:37+00:00
 * File:          app/code/Xtento/OrderExport/Model/ResourceModel/Log.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\OrderExport\Model\ResourceModel;

class Log extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('xtento_orderexport_log', 'log_id');
    }
}
