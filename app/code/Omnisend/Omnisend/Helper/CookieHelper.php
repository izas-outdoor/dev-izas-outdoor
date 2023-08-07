<?php

namespace Omnisend\Omnisend\Helper;

use Magento\Framework\Stdlib\CookieManagerInterface;

class CookieHelper
{
    const COOKIE_OMNISEND_EMAIL_ID = 'omnisendEmailID';

    /**
     * @var CookieManagerInterface
     */
    private $cookieManager;

    /**
     * @param CookieManagerInterface $cookieManager
     */
    public function __construct(CookieManagerInterface $cookieManager)
    {
        $this->cookieManager = $cookieManager;
    }

    /**
     * @return null|string
     */
    public function getOmnisendEmailId()
    {
        return $this->cookieManager->getCookie(self::COOKIE_OMNISEND_EMAIL_ID);
    }
}