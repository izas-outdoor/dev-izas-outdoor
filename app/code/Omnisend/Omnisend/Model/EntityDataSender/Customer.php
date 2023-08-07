<?php

namespace Omnisend\Omnisend\Model\EntityDataSender;

use Omnisend\Omnisend\Model\Api\Request\RequestInterface;
use Omnisend\Omnisend\Model\OmnisendContactFactory;
use Omnisend\Omnisend\Api\OmnisendContactRepositoryInterface;
use Omnisend\Omnisend\Helper\SearchCriteria\OmnisendContact as OmnisendContactSearchCriteria;
use Magento\Customer\Api\Data\CustomerInterface;

class Customer
{
    /**
     * @var RequestInterface
     */
    private $customerRequest;

    /**
     * @var OmnisendContactFactory
     */
    private $omnisendContactFactory;

    /**
     * @var OmnisendContactRepositoryInterface
     */
    private $omnisendContactRepository;

    /**
     * @var OmnisendContactSearchCriteria
     */
    private $omnisendContactSearchCriteria;

    /**
     * @param RequestInterface $customerRequest
     * @param OmnisendContactFactory $omnisendContactFactory
     * @param OmnisendContactRepositoryInterface $omnisendContactRepository
     * @param OmnisendContactSearchCriteria $omnisendContactSearchCriteria
     */
    public function __construct(
        RequestInterface $customerRequest,
        OmnisendContactFactory $omnisendContactFactory,
        OmnisendContactRepositoryInterface $omnisendContactRepository,
        OmnisendContactSearchCriteria $omnisendContactSearchCriteria
    ) {
        $this->customerRequest = $customerRequest;
        $this->omnisendContactFactory = $omnisendContactFactory;
        $this->omnisendContactRepository = $omnisendContactRepository;
        $this->omnisendContactSearchCriteria = $omnisendContactSearchCriteria;
    }

    /**
     * @param CustomerInterface $customer
     * @return null|string
     */
    public function send($customer)
    {
        $searchCriteria = $this->omnisendContactSearchCriteria->getOmnisendContactInStoreByCustomerIdSearchCriteria(
            $customer->getId(),
            $customer->getStoreId()
        );

        $omnisendContact = $this->omnisendContactRepository->getList($searchCriteria)->getFirstItem();

        if ($omnisendContact->getData() && $omnisendContact->getOmnisendId()) {
            return $this->customerRequest->patch($omnisendContact->getOmnisendId(), $customer, $customer->getStoreId());
        }

        $response = json_decode($this->customerRequest->post($customer, $customer->getStoreId()), true);

        if ($response == null) {
            return $response;
        }

        if (!$omnisendContact->getData()) {
            $omnisendContact = $this->omnisendContactFactory->create();
        }

        $omnisendContact->setCustomerId($customer->getId());
        $omnisendContact->setOmnisendId($response['contactID']);
        $omnisendContact->setStoreId($customer->getStoreId());

        $this->omnisendContactRepository->save($omnisendContact);

        return $response;
    }
}