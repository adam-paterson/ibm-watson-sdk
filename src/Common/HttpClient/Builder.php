<?php

declare(strict_types=1);

namespace IBM\Watson\Common\HttpClient;

use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Message\Authentication;
use Http\Message\UriFactory;
use IBM\Watson\Common\Util\DiscoveryTrait;
use Psr\Http\Message\UriInterface;

/**
 * Builder creates a user configured HTTP client.
 */
class Builder
{
    use DiscoveryTrait;

    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

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
    private $hostname;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $plugins = [];

    /**
     * @param HttpClient|null               $httpClient HTTP client for sending requests.
     * @param \Http\Message\UriFactory|null $uriFactory URI factory for creating URI.
     */
    public function __construct(
        HttpClient $httpClient = null,
        UriFactory $uriFactory = null
    ) {
        $this->httpClient = $httpClient ?: $this->discoverHttpClient();
        $this->uriFactory = $uriFactory ?: $this->discoverUriFactory();
    }

    /**
     * @return \Http\Client\Common\PluginClient HTTP client with configured plugins.
     */
    public function createConfiguredClient(): PluginClient
    {
        $this->addHostPlugin();
        $this->addPathPlugin();
        $this->addAuthenticationPlugin();

        return new PluginClient($this->httpClient, $this->plugins);
    }

    /**
     * @param \Http\Message\Authentication $authentication Authentication method.
     *
     * @return $this
     */
    public function withAuthentication(Authentication $authentication): self
    {
        $this->authentication = $authentication;

        return $this;
    }

    /**
     * @param string $hostname API Hostname.
     *
     * @return $this
     */
    public function withHostname(string $hostname): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @param string $path Default API path.
     *
     * @return $this
     */
    public function withPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Add authentication plugin to client.
     *
     * @return $this
     */
    private function addAuthenticationPlugin(): self
    {
        if (null !== $this->authentication) {
            $this->plugins[] = new AuthenticationPlugin($this->authentication);
        }

        return $this;
    }

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    private function getHostUri(): UriInterface
    {
        return $this->uriFactory->createUri($this->hostname);
    }

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    private function getPathUri(): UriInterface
    {
        return $this->uriFactory->createUri($this->path);
    }

    /**
     * @return \IBM\Watson\Common\HttpClient\Builder
     */
    private function addHostPlugin(): self
    {
        if (null !== $this->hostname) {
            $this->plugins[] = new AddHostPlugin($this->getHostUri());
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function addPathPlugin(): self
    {
        if (null !== $this->path) {
            $this->plugins[] = new AddPathPlugin($this->getPathUri());
        }

        return $this;
    }
}
