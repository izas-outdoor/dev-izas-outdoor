<?php

namespace Omnisend\Omnisend\Model;

use Omnisend\Omnisend\Helper\GmtDateHelper;
use Omnisend\Omnisend\Helper\ResponseRateManagerHelper;
use Omnisend\Omnisend\Api\OmnisendRateLimitRepositoryInterface;
use DateTime;

class ResponseRateManager implements ResponseRateManagerInterface
{
    /**
     * @var OmnisendRateLimitRepositoryInterface
     */
    private $omnisendRateLimitRepository;

    /**
     * @var GmtDateHelper
     */
    private $gmtDateHelper;

    /**
     * @var OmnisendRateLimitFactory
     */
    private $omnisendRateLimitFactory;

    /**
     * @var ResponseRateManagerHelper
     */
    private $responseRateManagerHelper;

    /**
     * ResponseRateManager constructor.
     * @param OmnisendRateLimitRepositoryInterface $omnisendRateLimitRepository
     * @param GmtDateHelper $gmtDateHelper
     * @param OmnisendRateLimitFactory $omnisendRateLimitFactory
     * @param ResponseRateManagerHelper $responseRateManagerHelper
     */
    public function __construct(
        OmnisendRateLimitRepositoryInterface $omnisendRateLimitRepository,
        GmtDateHelper $gmtDateHelper,
        OmnisendRateLimitFactory $omnisendRateLimitFactory,
        ResponseRateManagerHelper $responseRateManagerHelper
    ) {
        $this->omnisendRateLimitRepository = $omnisendRateLimitRepository;
        $this->gmtDateHelper = $gmtDateHelper;
        $this->omnisendRateLimitFactory = $omnisendRateLimitFactory;
        $this->responseRateManagerHelper = $responseRateManagerHelper;
    }

    /**
     * @param $responseHeader
     * @param $storeId
     * @return void
     */
    public function update($responseHeader, $storeId)
    {
        $headerValues = $this->responseRateManagerHelper->convertResponseHeaderStringToArray($responseHeader);

        $omnisendRateLimit = $this->omnisendRateLimitRepository->getById($storeId);

        if (!$omnisendRateLimit->getData()) {
            $omnisendRateLimit = $this->omnisendRateLimitFactory->create();
            $omnisendRateLimit->setId($storeId);
        }

        $omnisendRateLimit->setLimitTotal($headerValues[ResponseRateManagerInterface::X_RATE_LIMIT_LIMIT]);
        $omnisendRateLimit->setLimitRemaining($headerValues[ResponseRateManagerInterface::X_RATE_LIMIT_REMAINING]);
        $omnisendRateLimit->setResetsIn($headerValues[ResponseRateManagerInterface::X_RATE_LIMIT_RESET]);
        $omnisendRateLimit->setUpdatedAt($this->gmtDateHelper->getGmtDate());

        $this->omnisendRateLimitRepository->save($omnisendRateLimit);
    }

    /**
     * @param $storeId
     * @return boolean
     */
    public function check($storeId)
    {
        $omnisendRateLimit = $this->omnisendRateLimitRepository->getById($storeId);

        if (!$omnisendRateLimit->getData()) {
            return true;
        }

        if (!$this->isRateLimitExceeded($omnisendRateLimit)) {
            return true;
        }

        if ($this->isRateLimitExpired($omnisendRateLimit)) {
            return true;
        }

        return false;
    }

    /**
     * @param OmnisendRateLimit $omnisendRateLimit
     * @return bool
     */
    protected function isRateLimitExceeded(OmnisendRateLimit $omnisendRateLimit)
    {
        $total = $omnisendRateLimit->getLimitTotal();
        $remaining = $omnisendRateLimit->getLimitRemaining();

        if ($total * self::RATE_LIMIT_SAFETY_MARGIN <= $remaining) {
            return false;
        }

        return true;
    }

    /**
     * @param OmnisendRateLimit $omnisendRateLimit
     * @return bool
     */
    protected function isRateLimitExpired(OmnisendRateLimit $omnisendRateLimit)
    {
        $resetsIn = $omnisendRateLimit->getResetsIn();

        $updatedAt = new DateTime($omnisendRateLimit->getUpdatedAt());
        $currentDate = new DateTime($this->gmtDateHelper->getGmtDate());

        $dateDifference = $currentDate->getTimestamp() - $updatedAt->getTimestamp();

        if ($dateDifference > $resetsIn) {
            return true;
        }

        return false;
    }
}