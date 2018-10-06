<?php

declare(strict_types=1);

namespace IBM\Watson\ToneAnalyzer;

use Http\Message\UriFactory;
use Http\Message\Authentication;
use Http\Discovery\UriFactoryDiscovery;
use Http\Client\Common\HttpMethodsClient;
use IBM\Watson\Core\Hydrator\ModelHydrator;
use IBM\Watson\Core\Client\HttpClient\Builder;
use IBM\Watson\Core\Hydrator\HydratorInterface;

/**
 * Tone Analyzer Client
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class Client
{
    /**
     * @var \Http\Client\Common\HttpMethodsClient
     */
    private $httpClient;

    /**
     * @var \IBM\Watson\Core\Hydrator\HydratorInterface|\IBM\Watson\Core\Hydrator\ModelHydrator
     */
    private $hydrator;

    /**
     * @var \Http\Message\UriFactory
     */
    private $uriFactory;

    /**
     * @param \Http\Client\Common\HttpMethodsClient       $httpClient
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface $hydrator
     * @param \Http\Message\UriFactory|null               $uriFactory
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
     * Create authorized ToneAnalyzer client.
     *
     * @param \Http\Message\Authentication $authentication
     *
     * @return \IBM\Watson\ToneAnalyzer\Client
     */
    public static function create(Authentication $authentication): Client
    {
        $httpClient = (new Builder())
            ->withHost('https://gateway.watsonplatform.net')
            ->withPath('tone-analyzer/api')
            ->withAuthentication($authentication)
            ->withVersion(date('Y-m-d'))
            ->create();

        return new self($httpClient);
    }

    /**
     * Get Tone api endpoint.
     *
     * @return \IBM\Watson\ToneAnalyzer\Api\Tone
     */
    public function tone(): Api\Tone
    {
        return new Api\Tone($this->httpClient, $this->hydrator, $this->uriFactory);
    }

    /**
     * Get ToneChat api endpoint.
     *
     * @return \IBM\Watson\ToneAnalyzer\Api\ToneChat
     */
    public function toneChat(): Api\ToneChat
    {
        return new Api\ToneChat($this->httpClient, $this->hydrator, $this->uriFactory);
    }
}
