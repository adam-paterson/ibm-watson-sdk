<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Client\HttpClient;

use Http\Client\HttpClient;
use Http\Message\UriFactory;
use Http\Message\Authentication;
use Http\Message\RequestFactory;
use Http\Client\Common\PluginClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use IBM\Watson\Core\Client\HttpClient as ExceptionHandlerHttpClient;

/**
 * HTTP Client stack builder.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class Builder
{
    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var \Http\Message\UriFactory
     */
    private $uriFactory;

    /**
     * @var \Http\Message\Authentication
     */
    private $authentication;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $path;

    /*
     * @var string
     */
    private $version;

    /**
     * Create stacked HTTP client.
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public function create(): HttpMethodsClient
    {
        return new HttpMethodsClient($this->createPluginsClient(), $this->getRequestFactory());
    }

    /**
     * Add authentication interface to HTTP Client.
     *
     * @param \Http\Message\Authentication $authentication
     *
     * @return $this
     */
    public function withAuthentication(Authentication $authentication): self
    {
        $this->authentication = $authentication;

        return $this;
    }

    /**
     * Set base HTTP client to be set explicitly.
     *
     * @param \Http\Client\HttpClient $httpClient
     *
     * @return $this
     */
    public function setHttpClient(HttpClient $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Set request factory explicitly.
     *
     * @param \Http\Message\RequestFactory $requestFactory
     *
     * @return $this
     */
    public function setRequestFactory(RequestFactory $requestFactory): self
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }

    /**
     * Build HTTP client with specified host.
     *
     * @param string $host
     *
     * @return $this
     */
    public function withHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Set URI Factory explicitly.
     *
     * @param \Http\Message\UriFactory $uriFactory
     *
     * @return $this
     */
    public function setUriFactory(UriFactory $uriFactory): self
    {
        $this->uriFactory = $uriFactory;

        return $this;
    }

    /**
     * Add default request path to HTTP client.
     *
     * @param string $path
     *
     * @return $this
     */
    public function withPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Add version to HTTP client.
     *
     * @param string $version
     *
     * @return $this
     */
    public function withVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get or discover HTTP client class.
     *
     * @return \Http\Client\HttpClient
     */
    private function getHttpClient(): HttpClient
    {
        if (null === $this->httpClient) {
            $this->httpClient = HttpClientDiscovery::find();
        }

        return $this->httpClient;
    }

    /**
     * Get or discover Request Factory class.
     *
     * @return \Http\Message\RequestFactory
     */
    private function getRequestFactory(): RequestFactory
    {
        if (null === $this->requestFactory) {
            $this->requestFactory = MessageFactoryDiscovery::find();
        }

        return $this->requestFactory;
    }

    /**
     * Get or discover URI factory class.
     *
     * @return \Http\Message\UriFactory
     */
    private function getUriFactory(): UriFactory
    {
        if (null === $this->uriFactory) {
            $this->uriFactory = UriFactoryDiscovery::find();
        }

        return $this->uriFactory;
    }

    /**
     * Create stacked HTTP client.
     *
     * @return \Http\Client\Common\PluginClient
     */
    private function createPluginsClient(): PluginClient
    {
        $plugins = [];

        $plugins[] = new HeaderDefaultsPlugin(
            ['User-Agent' => 'adam-paterson/ibm-watson-sdk (https://github.com/adam-paterson/ibm-watson-sdk)']
        );

        if (null !== $this->authentication) {
            $plugins[] = new AuthenticationPlugin($this->authentication);
        }

        if (null !== $this->host) {
            $plugins[] = new AddHostPlugin($this->getUriFactory()->createUri($this->host));
        }

        if (null !== $this->path) {
            $plugins[] = new AddPathPlugin($this->getUriFactory()->createUri($this->path));
        }

        if (null !== $this->version) {
            $plugins[] = new QueryDefaultsPlugin([
                'version' => $this->version
            ]);
        }

        return new PluginClient(new ExceptionHandlerHttpClient($this->getHttpClient()), $plugins);
    }
}
