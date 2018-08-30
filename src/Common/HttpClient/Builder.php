<?php

namespace IBM\Watson\Common\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Message\Authentication\BasicAuth;
use Http\Message\UriFactory;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Util\DiscoveryTrait;

/**
 * HttpClient builder
 */
final class Builder
{
    use DiscoveryTrait;

    /**
     * @var \Http\Client\HttpClient|null
     */
    private $httpClient;

    /**
     * @var \Http\Message\UriFactory|null
     */
    private $uriFactory;

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
     * @param \Http\Client\HttpClient|null  $httpClient
     * @param \Http\Message\UriFactory|null $uriFactory
     */
    public function __construct(
        HttpClient $httpClient = null,
        UriFactory $uriFactory = null
    ) {
        $this->httpClient = $httpClient ?: $this->discoverHttpClient();
        $this->uriFactory = $uriFactory;
    }

    /**
     * Create a configured HTTP client
     *
     * @return \Http\Client\Common\PluginClient
     */
    public function createConfiguredClient()
    {
        if (null !== $this->username && null !== $this->password) {
            $this->plugins[] = new AuthenticationPlugin(new BasicAuth($this->username, $this->password));
        }

        return new PluginClient($this->httpClient, $this->plugins);
    }

    /**
     * Add username to client
     *
     * @param string $username
     *
     * @return $this
     */
    public function withUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Add password to client
     *
     * @param string $password
     *
     * @return $this
     */
    public function withPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Add username and password to client
     *
     * @param string $username
     * @param string $password
     *
     * @return \IBM\Watson\Common\HttpClient\Builder
     */
    public function withCredentials($username, $password)
    {
        return $this
            ->withUsername($username)
            ->withPassword($password);
    }

    /**
     * @param \Http\Client\Common\Plugin ...$plugins
     *
     * @return $this
     */
    public function addPlugin(Plugin ...$plugins)
    {
        foreach ($plugins as $plugin) {
            $this->plugins[] = $plugin;
        }

        return $this;
    }
}
