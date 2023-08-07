<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Izas\Empathy\Cron;

use GuzzleHttp\Client;

use GuzzleHttp\ClientFactory;

use GuzzleHttp\Exception\GuzzleException;

use GuzzleHttp\Psr7\Response;

use GuzzleHttp\Psr7\ResponseFactory;

use Magento\Framework\Webapi\Rest\Request;

use Psr\Log\LoggerInterface;

use Magento\Framework\HTTP\Client\Curl;

class FeedEn
{

    /**

     * API request URL

     */

    const API_REQUEST_URI = 'https://api.empathy.co/index/v1/';


    /**

     * API request endpoint

     */

    const API_REQUEST_ENDPOINT = 'jobs/submit/';


    /**
    * @var \Magento\Framework\HTTP\Client\Curl
    */

    protected $curl;

    /**

     * @var ResponseFactory

     */

    private $responseFactory;


    /**

     * @var ClientFactory

     */

    private $clientFactory;

    protected $logger;

    public function __construct(LoggerInterface $logger, Curl $curl) {
        $this->logger = $logger;
        $this->curl = $curl;
    }

	public function execute()
	{
        try {
            $sitedId = 'izas/';

            $clientToken = '62b570bb1df02b1f4870e5bd/';
    
            $feedId = 'catalog';
    
            //Actualización feed EN
            $langId = '?pivots=lang&lang=en';
    
            $url = self::API_REQUEST_URI . self::API_REQUEST_ENDPOINT. $sitedId . $clientToken . $feedId . $langId;
            //Initiate cURL
            $this->curl = curl_init($url);

            curl_setopt ($this->curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));

            $xmlStrEN = file_get_contents('https://www.izas-outdoor.com/amfeed/feed/download?id=15&file=empathy-EN.xml.xml'); // read file to string
            //$byte_arrayEN = unpack('C*', $xmlStrEN); // convert string to byte array
    
            //Set CURLOPT_POST to true to send a POST request.
            curl_setopt($this->curl, CURLOPT_POST, true);

            //Attach the XML string to the body of our request.
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $xmlStrEN);

            //Tell cURL that we want the response to be returned as
            //a string instead of being dumped to the output.
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

            //Execute the POST request and send our XML.
            $result = curl_exec($this->curl);

            //Close the cURL handle.
            curl_close($this->curl);
            //$params['file'] = $xmlStrEN;
            
            //$this->curl->post($url, $params);

            //return $this;
        } catch (\LogicException $e) {
            $this->logger->info(
                sprintf(
                    'Error produced during execution cron Empathy Feed. %s',
                    $e->getMessage()
                )
            );
            return false;
        }
        

	}

     /**

     * Do API request with provided params

     *

     * @param string $uriEndpoint

     * @param array $params

     * @param string $requestMethod

     *

     * @return Response

     */

    private function doRequest(

        string $uriEndpoint,

        array $params = [],

        string $requestMethod = Request::HTTP_METHOD_GET

    ): Response {

        /** @var Client $client */

        $client = $this->clientFactory->create(['config' => [

            'base_uri' => self::API_REQUEST_URI

        ]]);


        try {

            $response = $client->request(

                $requestMethod,

                $uriEndpoint,

                $params

            );

        } catch (GuzzleException $exception) {

            /** @var Response $response */

            $response = $this->responseFactory->create([

                'status' => $exception->getCode(),

                'reason' => $exception->getMessage()

            ]);

        }


        return $response;

    }
}

