<?php

namespace Omnisend\Omnisend\Model;

use Exception;
use Psr\Log\LoggerInterface;

class RequestService implements RequestServiceInterface
{
    const HTTP_RESPONSE_NOT_FOUND = '404';

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @param ResponseFactory $responseFactory
     * @param LoggerInterface $logger
     * @param ResponseRateManagerInterface $responseRateManager
     */
    public function __construct(
        ResponseFactory $responseFactory,
        LoggerInterface $logger,
        ResponseRateManagerInterface $responseRateManager
    ) {
        $this->responseFactory = $responseFactory;
        $this->logger = $logger;
        $this->responseRateManager = $responseRateManager;
    }

    /**
     * @param RequestDataInterface $requestData
     * @return null|string
     */
    public function call(RequestDataInterface $requestData)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $requestData->getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HEADER => 1,
            CURLOPT_CUSTOMREQUEST => $requestData->getType(),
            CURLOPT_POSTFIELDS => $requestData->getBody(),
            CURLOPT_HTTPHEADER => $requestData->getHeader()
        ));

        try {
            $responseData = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            list($responseHeader, $responseBody) = explode("\r\n\r\n", $responseData, 2);

            if (strpos($responseHeader, "100 Continue") !== false) {
                list($responseHeader, $responseBody) = explode("\r\n\r\n", $responseBody, 2);
            }

            $this->responseRateManager->update($responseHeader, $requestData->getStoreId());

            $response = $this->responseFactory->create();
            $response->setResponse($responseBody, $httpCode);

            if (!$response->hasError()) {
                return $response->getData();
            }

            if ($response->getResponseCode() == self::HTTP_RESPONSE_NOT_FOUND) {
                return $response->getResponseCode();
            }

            throw new Exception($response->getError());
        } catch (Exception $exception) {
            $this->logger->critical(
                $requestData->getUrl() . ' ' .
                $requestData->getType() . ' ' .
                $requestData->getBody() . ' ' .
                $exception->getMessage());
        }

        return null;
    }
}