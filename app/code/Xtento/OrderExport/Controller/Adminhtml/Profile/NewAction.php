<?php

/**
 * Product:       Xtento_OrderExport
 * ID:            fso5z3a0QaKnCwcGMUjyKBrw+XWvPsrvsDClR8Fc3jg=
 * Last Modified: 2015-08-07T16:15:19+00:00
 * File:          app/code/Xtento/OrderExport/Controller/Adminhtml/Profile/NewAction.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\OrderExport\Controller\Adminhtml\Profile;

class NewAction extends \Xtento\OrderExport\Controller\Adminhtml\Profile
{
    /**
     * Forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_FORWARD);
        return $result->forward('edit');
    }
}