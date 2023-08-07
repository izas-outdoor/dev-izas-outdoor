<?php

/**
 * Product:       Xtento_OrderExport
 * ID:            fso5z3a0QaKnCwcGMUjyKBrw+XWvPsrvsDClR8Fc3jg=
 * Last Modified: 2016-04-17T13:03:38+00:00
 * File:          app/code/Xtento/OrderExport/Observer/CustomerSaveAfterObserver.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\OrderExport\Observer;

use Xtento\OrderExport\Model\Export;

class CustomerSaveAfterObserver extends AbstractEventObserver implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Check if customer is not new, only export then
        if (!$observer->getCustomer()->isObjectNew()) {
            $this->handleEvent($observer, self::EVENT_CUSTOMER_SAVE_AFTER, Export::ENTITY_CUSTOMER);
        }
    }
}
