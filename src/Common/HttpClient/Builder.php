<?php

namespace IBM\Watson\Common\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\UriFactoryDiscovery;
use http\Exception\RuntimeException;
use Http\Message\Authentication\BasicAuth;
use Http\Message\UriFactory;
use IBM\Watson\Common\Exception\Api\InvalidArgumentException;
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
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $version;

    /**
     * @param \Http\Client\HttpClient|null  $httpClient
     * @param \Http\Message\UriFactory|null $uriFactory
     */
    public function __construct(
        HttpClient $httpClient = null,
        UriFactory $uriFactory = null
    ) {
        $this->httpClient = $httpClient ?: $this->discoverHttpClient();
        $this->uriFactory = $uriFactory ?: $this->discoverUriFactory();
    }

    /**
     * Create a configured HTTP client
     *
     * @return \Http\Client\Common\PluginClient
     * @throws \Exception
     */
    public function createConfiguredClient()
    {
        $this->addHostPlugin();
        $this->addPathPlugin();
        $this->addVersionQueryPlugin();
        $this->addAuthenticationPlugin();

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
     * @param string $host
     *
     * @return $this
     */
    public function withHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function withVersion($version)
    {
        $this->version = $version;

        return $this;
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

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    private function getHostUri()
    {
        return $this->uriFactory->createUri($this->host);
    }

    /**
     * @param string $version
     *
     * @return bool
     */
    private function validateVersion($version)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $version);

        return $date && $date->format('Y-m-d') === $version;
    }

    /**
     * @return $this
     */
    private function addHostPlugin()
    {
        if (null !== $this->host) {
            $this->plugins[] = new Plugin\AddHostPlugin($this->getHostUri());
        }

        return $this;
    }


    /**
     * @return $this
     */
    private function addAuthenticationPlugin()
    {
        if (null !== $this->username && null !== $this->password) {
            $this->plugins[] = new AuthenticationPlugin(new BasicAuth($this->username, $this->password));
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function addVersionQueryPlugin()
    {
        if (null === $this->version) {
            $this->version = date('Y-m-d');
        }

        if (!$this->validateVersion($this->version)) {
            throw new InvalidArgumentException('Version must be a date in the Y-m-d format');
        }

        $this->plugins[] = new Plugin\QueryDefaultsPlugin([
            'version' => $this->version
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    private function addPathPlugin()
    {
        $this->plugins[] = new Plugin\AddPathPlugin($this->uriFactory->createUri('/tone-analyzer/api/v3'));

        return $this;
    }
}
