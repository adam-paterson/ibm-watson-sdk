<?php

declare(strict_types=1);

namespace IBM\Watson\Common\HttpClient;

use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
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
     * @var array
     */
    private $plugins = [];

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

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
     * Add username and password to client.
     *
     * @param string $username API username.
     * @param string $password API password.
     *
     * @return \IBM\Watson\Common\HttpClient\Builder
     */
    public function withCredentials($username, $password): self
    {
        return $this
            ->withUsername($username)
            ->withPassword($password);
    }

    /**
     * Add username to client.
     *
     * @param string $username API username.
     *
     * @return $this
     */
    public function withUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Add password to client.
     *
     * @param string $password API password.
     *
     * @return $this
     */
    public function withPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Add BasicAuth authentication plugin to client.
     *
     * @return $this
     */
    private function addAuthenticationPlugin(): self
    {
        if (null !== $this->username && null !== $this->password) {
            $this->plugins[] = new AuthenticationPlugin(new BasicAuth($this->username, $this->password));
        }

        return $this;
    }
}
