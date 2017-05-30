<?php
/** @noinspection PhpDocSignatureInspection */
	/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Operation;

use Ls\Omni\Client\IRequest;
use Ls\Omni\Client\IResponse;
use Ls\Omni\Client\IOperation;
use Ls\Omni\Client\AbstractOperation;
use Ls\Omni\Service\Service as OmniService;
use Ls\Omni\Service\ServiceType;
use Ls\Omni\Service\Soap\Client as OmniClient;
use Ls\Omni\Client\Ecommerce\ClassMap;
use Ls\Omni\Client\Ecommerce\Entity\ReplEcommCurrency as ReplEcommCurrencyRequest;
use Ls\Omni\Client\Ecommerce\Entity\ReplEcommCurrencyResponse as ReplEcommCurrencyResponse;

class ReplEcommCurrency extends AbstractOperation implements IOperation
{

    const OPERATION_NAME = 'REPL_ECOMM_CURRENCY';

    const SERVICE_TYPE = 'ecommerce';

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @property OmniClient $client
     */
    public $client = null;

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @property ReplEcommCurrencyRequest $request
     */
    private $request = null;

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @property ReplEcommCurrencyResponse $response
     */
    private $response = null;

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @property ReplEcommCurrencyRequest $request_xml
     */
    private $request_xml = null;

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @property ReplEcommCurrencyResponse $response_xml
     */
    private $response_xml = null;

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @property mixed $error
     */
    private $error = null;

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param ReplEcommCurrencyRequest $request
     * @return IResponse|ReplEcommCurrencyResponse
     */
    public function __construct()
    {
        $service_type = new ServiceType( self::SERVICE_TYPE );
        parent::__construct( $service_type );
        $url = OmniService::getUrl( $service_type ); 
        $this->client = new OmniClient( $url, $service_type );
        $this->client->setClassmap( $this->getClassMap() );
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param ReplEcommCurrencyRequest $request
     * @return IResponse|ReplEcommCurrencyResponse
     */
    public function execute(IRequest $request = null)
    {
        if ( !is_null( $request ) ) {
            $this->setRequest( $request );
        }
        return $this->makeRequest( 'ReplEcommCurrency' );
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return ReplEcommCurrencyRequest
     */
    public function & getOperationInput()
    {
        if ( is_null( $this->request ) ) {
            $this->request = new ReplEcommCurrencyRequest();
        }
        return $this->request;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return array
     */
    public function getClassMap()
    {
        return ClassMap::getClassMap();
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param OmniClient $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return OmniClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param ReplEcommCurrencyRequest $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return ReplEcommCurrencyRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param ReplEcommCurrencyResponse $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return ReplEcommCurrencyResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param ReplEcommCurrencyRequest $request_xml
     * @return $this
     */
    public function setRequestXml($request_xml)
    {
        $this->request_xml = $request_xml;
        return $this;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return ReplEcommCurrencyRequest
     */
    public function getRequestXml()
    {
        return $this->request_xml;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param ReplEcommCurrencyResponse $response_xml
     * @return $this
     */
    public function setResponseXml($response_xml)
    {
        $this->response_xml = $response_xml;
        return $this;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return ReplEcommCurrencyResponse
     */
    public function getResponseXml()
    {
        return $this->response_xml;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @param mixed $error
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /** @noinspection PhpDocSignatureInspection */
	/**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


}

