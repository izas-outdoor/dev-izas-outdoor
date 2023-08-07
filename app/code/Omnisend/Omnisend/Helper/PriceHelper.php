<?php

namespace Omnisend\Omnisend\Helper;

class PriceHelper
{
    /**
     * @param $price
     * @return int
     */
    public function getPriceInCents($price)
    {
        return $price * 100;
    }
}