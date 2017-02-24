<?php
/**
 * Base Watson service class
 */
namespace IBM\Watson\Common;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Base Watson service class
 *
 * This abstract class should be extended by all Watson services
 * throughout the SDK. It enforces implementation of
 * the ServiceInterface and defines various common attributes
 * and methods that all services should have.
 *
 * @see ServiceInterface
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $httpRequest;

    /**
     * Create a new service instance
     *
     * @param ClientInterface $httpClient   A Guzzle client to make API calls with
     * @param Request         $httpRequest  A Symfony HTTP request object
     */
    public function __construct(ClientInterface $httpClient = null, Request $httpRequest = null)
    {
        $this->httpClient = $httpClient ?: $this->getDefaultHttpClient();
        $this->httpRequest = $httpRequest ?: $this->getDefaultHttpRequest();
        $this->initialize();
    }

    /**
     * Initialize this service with default parameters
     *
     * @param array $parameters
     * @return $this
     */
    public function initialize(array $parameters = [])
    {
        $this->parameters = new ParameterBag;

        foreach ($this->getDefaultParameters() as $key => $value) {
            if (is_array($value)) {
                $this->parameters->set($key, reset($value));
            } else {
                $this->parameters->set($key, $value);
            }
        }

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'username' => '',
            'password' => ''
        ];
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get the global default HTTP client
     *
     * @return Client
     */
    protected function getDefaultHttpClient()
    {
        return new Client([
            'curl.options'  => [CURLOPT_CONNECTTIMEOUT => 60],
        ]);
    }

    /**
     * Get the global default HTTP request
     *
     * @return Request
     */
    protected function getDefaultHttpRequest()
    {
        return Request::createFromGlobals();
    }

    /**
     * Create and initialize a request object
     *
     * @see \IBM\Watson\Common\Message\AbstractRequest
     * @param string $class The request class name
     * @param array $parameters
     *
     * @return \IBM\Watson\Common\Message\AbstractRequest
     */
    protected function createRequest($class, array $parameters)
    {
        $obj = new $class($this->httpClient, $this->httpRequest);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }
}
