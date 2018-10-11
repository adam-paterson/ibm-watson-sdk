<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator;

use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\Authentication;
use Http\Message\UriFactory;
use IBM\Watson\Core\Client\HttpClient\Builder;
use IBM\Watson\Core\ClientInterface;
use IBM\Watson\Core\Hydrator\HydratorInterface;
use IBM\Watson\Core\Hydrator\ModelHydrator;

/**
 * IBM Watson&trade; Language Translator translates text from one language to another. The service offers multiple IBM
 * provided translation models that you can customize based on your unique terminology and language. Use Language
 * Translator to take news from across the globe and present it in your language, communicate with your customers in
 * their own language, and more.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class Client implements ClientInterface
{
    const API_HOST = 'https://gateway.watsonplatform.net';
    const API_PATH = 'language-translator/api';

    private $httpClient;
    private $hydrator;
    private $uriFactory;

    /**
     * @param \Http\Client\Common\HttpMethodsClient            $httpClient
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface|null $hydrator
     * @param \Http\Message\UriFactory|null                    $uriFactory
     */
    public function __construct(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator = null,
        UriFactory $uriFactory = null
    ) {
        $this->httpClient = $httpClient;
        $this->hydrator   = $hydrator ?? new ModelHydrator();
        $this->uriFactory = $uriFactory ?? UriFactoryDiscovery::find();
    }

    /**
     * @param \Http\Message\Authentication                     $authentication
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface|null $hydrator
     *
     * @return \IBM\Watson\LanguageTranslator\Client|mixed
     */
    public static function create(Authentication $authentication, HydratorInterface $hydrator = null)
    {
        $httpClient = (new Builder())
            ->withHost(static::API_HOST)
            ->withPath(static::API_PATH)
            ->withVersion(date('Y-m-d'))
            ->withAuthentication($authentication)
            ->create();

        return new self($httpClient, $hydrator);
    }

    /**
     * @return \IBM\Watson\LanguageTranslator\Api\Identification
     */
    public function identification(): Api\Identification
    {
        return new Api\Identification($this->httpClient, $this->hydrator, $this->uriFactory);
    }

    public function translation()
    {
        return new Api\Translation($this->httpClient, $this->hydrator, $this->uriFactory);
    }
}
