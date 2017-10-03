<?php

namespace IBM\Watson\Common\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Http\Message\UriFactory;

final class Builder
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \Http\Client\HttpClient
     */
    private $httpClient;

    /**
     * @var \Http\Message\UriFactory
     */
    private $uriFactory;

    /**
     * @var array
     */
    private $pluginsAppend = [];

    /**
     * @var array
     */
    private $pluginsPrepend = [];

    /**
     * Builder constructor.
     *
     * @param \Http\Client\HttpClient|null      $httpClient
     * @param \Http\Message\UriFactory|null     $uriFactory
     *
     * @throws \Http\Discovery\Exception\NotFoundException
     */
    public function __construct(
        HttpClient $httpClient = null,
        UriFactory $uriFactory = null
    ) {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->uriFactory = $uriFactory ?: UriFactoryDiscovery::find();
    }

    /**
     * Create HTTP client with specified plugins
     *
     * @return \Http\Client\Common\PluginClient
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function createConfiguredClient()
    {
        $plugins = $this->pluginsPrepend;

        $plugins[] = new HeaderDefaultsPlugin([
            'User-Agent' => 'adam-paterson/ibm-watson-sdk (https://github.com/adam-paterson/ibm-watson-sdk)'
        ]);

        if (null !== $this->endpoint) {
            $plugins[] = new Plugin\BaseUriPlugin($this->uriFactory->createUri($this->endpoint));
        }

        if (null !== $this->username && null !== $this->password) {
            $plugins[] = new AuthenticationPlugin(new BasicAuth($this->username, $this->password));
        }

        return new PluginClient($this->httpClient, array_merge($plugins, $this->pluginsAppend));
    }

    /**
     * Add endpoint to client
     *
     * @param string $endpoint
     *
     * @return $this
     */
    public function withEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
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
     * @return $this
     */
    public function withCredentials($username, $password)
    {
        return $this
            ->withUsername($username)
            ->withPassword($password);
    }

    /**
     * Add plugins to client after it has been configured
     *
     * @param \Http\Client\Common\Plugin|\Http\Client\Common\Plugin[] ...$plugins
     *
     * @return $this
     */
    public function appendPlugin(Plugin ...$plugins)
    {
        foreach ($plugins as $plugin) {
            $this->pluginsAppend[] = $plugin;
        }

        return $this;
    }

    /**
     * Add plugins to client before it has been configured
     *
     * @param \Http\Client\Common\Plugin|\Http\Client\Common\Plugin[] ...$plugins
     *
     * @return $this
     */
    public function prependPlugin(Plugin ...$plugins)
    {
        $plugins = array_reverse($plugins);

        foreach ($plugins as $plugin) {
            array_unshift($this->pluginsPrepend, $plugin);
        }

        return $this;
    }
}
