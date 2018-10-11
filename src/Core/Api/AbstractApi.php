<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Api;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\UriFactory;
use IBM\Watson\Core\Hydrator\HydratorInterface;

/**
 * Abstract API class all Watson API classes should extend.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
abstract class AbstractApi implements ApiInterface
{
    const HEADER_CONTENT_TYPE = 'Content-Type';

    const HEADER_CONTENT_LANGUAGE = 'Content-Language';

    const HEADER_ACCEPT_LANGUAGE = 'Accept-Language';

    const PARAM_CONTENT_TYPE = 'content_type';

    const PARAM_ACCEPT_LANGUAGE = 'accept_language';

    const PARAM_CONTENT_LANGUAGE = 'content_language';

    const DEFAULT_HEADER_CONTENT_LANGUAGE = 'en';

    const DEFAULT_HEADER_ACCEPT_LANGUAGE = 'en';

    /**
     * @var \IBM\Watson\Core\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \Http\Client\Common\HttpMethodsClient
     */
    protected $httpClient;

    /**
     * @var \Http\Message\UriFactory
     */
    protected $uriFactory;

    /**
     * @param \Http\Client\Common\HttpMethodsClient       $httpClient
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface $hydrator
     * @param \Http\Message\UriFactory                    $uriFactory
     */
    public function __construct(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator,
        UriFactory $uriFactory
    ) {
        $this->httpClient = $httpClient;
        $this->hydrator   = $hydrator;
        $this->uriFactory = $uriFactory;
    }

    /**
     * Validate user provided parameters against those which are allowed in the API calls.
     *
     * @param array $parameters
     *
     * @return array
     */
    public function validateParameters(array $parameters = []): array
    {
        return array_filter($parameters, function ($parameter) {
            return \in_array($parameter, $this->getAllowedParameters(), true);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Get headers based on parameters. Will return defaults when available.
     *
     * @param array $parameters
     *
     * @return array
     */
    protected function getHeaders(array $parameters): array
    {
        $parameters = $this->validateParameters($parameters);

        $contentLang = $parameters[static::PARAM_CONTENT_LANGUAGE] ?? static::DEFAULT_HEADER_CONTENT_LANGUAGE;
        $acceptLang  = $parameters[static::PARAM_ACCEPT_LANGUAGE] ?? static::DEFAULT_HEADER_ACCEPT_LANGUAGE;

        return [
            static::HEADER_CONTENT_LANGUAGE => $contentLang,
            static::HEADER_ACCEPT_LANGUAGE  => $acceptLang,
        ];
    }
}
