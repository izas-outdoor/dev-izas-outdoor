<?php

namespace Omnisend\Omnisend\Model;

interface RequestServiceInterface
{
    /**
     * @param RequestDataInterface $requestData
     * @return string
     */
    public function call(RequestDataInterface $requestData);
}