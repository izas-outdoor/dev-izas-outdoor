<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Setup\InstallData;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Subscriber extends AbstractDb
{
    const TABLE_NEWSLETTER_SUBSCRIBER = 'newsletter_subscriber';
    const SUBSCRIBER_ID = 'subscriber_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NEWSLETTER_SUBSCRIBER, self::SUBSCRIBER_ID);
    }

    /**
     * @param $subscriberId
     * @param $isImported
     */
    public function updateIsImported($subscriberId, $isImported)
    {
        $this->getConnection()->update(
            self::TABLE_NEWSLETTER_SUBSCRIBER,
            [InstallData::IS_IMPORTED => $isImported],
            self::SUBSCRIBER_ID . ' = ' . $subscriberId
        );
    }

    /**
     * @return int
     */
    public function resetIsImportedValues()
    {
        return $this->getConnection()->update(
            self::TABLE_NEWSLETTER_SUBSCRIBER,
            [InstallData::IS_IMPORTED => InstallData::DEFAULT_IS_IMPORTED_VALUE],
            InstallData::IS_IMPORTED . ' = ' . InstallData::IMPORTED_ATTRIBUTE_VALUE
        );
    }
}
