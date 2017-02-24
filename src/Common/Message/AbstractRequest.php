<?php
/**
 * Abstract Request
 */

namespace IBM\Watson\Common\Message;

use GuzzleHttp\ClientInterface;
use IBM\Watson\Common\Exception\RuntimeException;
use IBM\Watson\Common\Helper;
use Omnipay\Common\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Abstract Request
 *
 * This abstract class implements RequestInterface and defines a basic
 * set of functions that all Watson Request are intended to include.
 *
 * @see RequestInterface
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * The request parameters
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * The request client
     *
     * @var \Guzzle\Http\ClientInterface
     */
    protected $httpClient;

    /**
     * The HTTP request object
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $httpRequest;

    /**
     * An associated ResponseInterface
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Create a new Request
     *
     * @param ClientInterface $httpClient A Guzzle client to make API calls with
     * @param Request         $httpRequest A Symfony HTTP requet object
     */
    public function __construct(ClientInterface $httpClient, Request $httpRequest)
    {
        $this->httpClient = $httpClient;
        $this->httpRequest = $httpRequest;
        $this->initialize();
    }

    /**
     * Initialize the request with parameters
     *
     * @param array $parameters Associative array of parameters
     *
     * @return $this
     * @throws RuntimeException
     */
    public function initialize(array $parameters = [])
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * Get all parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * Get a parameter
     *
     * @param string $key The parameter key
     * @param mixed $default Default value
     * @return mixed
     */
    public function getParameter($key, $default = null)
    {
        return $this->parameters->get($key, $default);
    }

    /**
     * Get the API username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set the API username
     *
     * @param string $value
     *
     * @return $this
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * Get the API password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set the API password
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get request data
     *
     * @return array
     */
    public function getData()
    {
        return [
            'username'  => $this->getUsername(),
            'password'  => $this->getPassword(),
        ];
    }

    /**
     * Get the associated Response
     *
     * @return ResponseInterface
     * @throws RuntimeException
     */
    public function getResponse()
    {
        if (null === $this->response) {
            throw new RuntimeException('You must call send() before accessing the Response!');
        }

        return $this->response;
    }

    /**
     * Send the request
     *
     * @return ResponseInterface
     */
    public function send()
    {
        $data = $this->getData();

        return $this->sendData($data);
    }

    /**
     * Set a parameter on the request
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     * @throws RuntimeException
     */
    protected function setParameter($key, $value)
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters->set($key, $value);

        return $this;
    }
}
