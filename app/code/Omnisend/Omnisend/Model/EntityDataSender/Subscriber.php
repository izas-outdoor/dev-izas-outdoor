<?php

namespace Omnisend\Omnisend\Model\EntityDataSender;

use Omnisend\Omnisend\Api\Data\OmnisendGuestSubscriberInterface;
use Omnisend\Omnisend\Api\OmnisendGuestSubscriberRepositoryInterface;
use Omnisend\Omnisend\Model\Api\Request\RequestInterface;
use Omnisend\Omnisend\Model\OmnisendGuestSubscriberFactory;
use Omnisend\Omnisend\Helper\SearchCriteria\OmnisendGuestSubscriber as OmnisendSubscriberSearchCriteria;
use Exception;
use Magento\Framework\Json\Helper\Data;
use Magento\Newsletter\Model\Subscriber as NewsletterSubscriber;
use Psr\Log\LoggerInterface;

class Subscriber
{
    /**
     * @var RequestInterface
     */
    private $subscriberRequest;

    /**
     * @var OmnisendGuestSubscriberFactory
     */
    private $omnisendGuestSubscriberFactory;

    /**
     * @var OmnisendGuestSubscriberRepositoryInterface
     */
    private $omnisendGuestSubscriberRepository;

    /**
     * @var OmnisendSubscriberSearchCriteria
     */
    private $omnisendSubscriberSearchCriteria;

    /**
     * @var Data
     */
    private $jsonHelper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param RequestInterface $subscriberRequest
     * @param OmnisendGuestSubscriberFactory $omnisendGuestSubscriberFactory
     * @param OmnisendGuestSubscriberRepositoryInterface $omnisendGuestSubscriberRepository
     * @param OmnisendSubscriberSearchCriteria $omnisendSubscriberSearchCriteria
     * @param Data $jsonHelper
     * @param LoggerInterface $logger
     */
    public function __construct(
        RequestInterface $subscriberRequest,
        OmnisendGuestSubscriberFactory $omnisendGuestSubscriberFactory,
        OmnisendGuestSubscriberRepositoryInterface $omnisendGuestSubscriberRepository,
        OmnisendSubscriberSearchCriteria $omnisendSubscriberSearchCriteria,
        Data $jsonHelper,
        LoggerInterface $logger
    ) {
        $this->subscriberRequest = $subscriberRequest;
        $this->omnisendGuestSubscriberFactory = $omnisendGuestSubscriberFactory;
        $this->omnisendGuestSubscriberRepository = $omnisendGuestSubscriberRepository;
        $this->omnisendSubscriberSearchCriteria = $omnisendSubscriberSearchCriteria;
        $this->jsonHelper = $jsonHelper;
        $this->logger = $logger;
    }

    /**
     * @param NewsletterSubscriber $subscriber
     * @return null|string
     */
    public function send($subscriber)
    {
        $subscriberId = $subscriber->getSubscriberId();

        $searchCriteria = $this->omnisendSubscriberSearchCriteria->getOmnisendSubscriberInStoreBySubscriberIdSearchCriteria(
            $subscriberId,
            $subscriber->getStoreId()
        );

        $omnisendContact = $this->omnisendGuestSubscriberRepository->getList($searchCriteria)->getFirstItem();

        if ($omnisendContact->getData() && $omnisendContact->getOmnisendId()) {
            return $this->subscriberRequest->patch($omnisendContact->getOmnisendId(), $subscriber, $subscriber->getStoreId());
        }

        $response = $this->jsonHelper->jsonDecode($this->subscriberRequest->post($subscriber, $subscriber->getStoreId()));

        if ($response == null) {
            return $response;
        }

        $this->processOmnisendSubscriberContact($omnisendContact, $subscriber, $subscriberId, $response);

        return $response;
    }

    /**
     * @param OmnisendGuestSubscriberInterface $omnisendContact
     * @param NewsletterSubscriber $subscriber
     * @param int $subscriberId
     * @param array $response
     */
    protected function processOmnisendSubscriberContact($omnisendContact, $subscriber, $subscriberId, $response)
    {
        if (!$omnisendContact->getData()) {
            $omnisendContact = $this->omnisendGuestSubscriberFactory->create();
        }

        $omnisendContact->setSubscriberId($subscriberId);
        $omnisendContact->setOmnisendId($response['contactID']);
        $omnisendContact->setStoreId($subscriber->getStoreId());

        try {
            $this->omnisendGuestSubscriberRepository->save($omnisendContact);
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }
}