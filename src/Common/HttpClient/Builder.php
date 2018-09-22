<?php

declare(strict_types=1);

namespace IBM\Watson\Common\HttpClient;

use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Message\Authentication;
use Http\Message\Authentication\BasicAuth;
use IBM\Watson\Common\Util\DiscoveryTrait;

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
     * @var \Http\Message\Authentication
     */
    private $authentication;

    /**
     * @var array
     */
    private $plugins = [];

    /**
     * @param HttpClient|null $httpClient HTTP Client for sending requests.
     */
    public function __construct(
        HttpClient $httpClient = null
    ) {
        $this->httpClient = $httpClient ?: $this->discoverHttpClient();
    }

    /**
     * @return \Http\Client\Common\PluginClient HTTP client with configured plugins.
     */
    public function createConfiguredClient(): PluginClient
    {
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
     * Add BasicAuth authentication plugin to client.
     *
     * @return $this
     */
    private function addAuthenticationPlugin(): self
    {
        return $this;
    }
}
