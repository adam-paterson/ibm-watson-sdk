<?php

declare(strict_types=1);

namespace IBM\Watson\Core;

use Http\Client\Common\HttpMethodsClient;
use Http\Message\Authentication;
use Http\Message\UriFactory;
use IBM\Watson\Core\Hydrator\HydratorInterface;

/**
 * Watson API client interface.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
interface ClientInterface
{
    /**
     * ClientInterface constructor.
     *
     * @param \Http\Client\Common\HttpMethodsClient            $httpClient
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface|null $hydrator
     * @param \Http\Message\UriFactory|null                    $uriFactory
     */
    public function __construct(
        HttpMethodsClient $httpClient,
        HydratorInterface $hydrator = null,
        UriFactory $uriFactory = null
    );

    /**
     * @param \Http\Message\Authentication                     $authentication
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface|null $hydrator
     *
     * @return mixed
     */
    public static function create(Authentication $authentication, HydratorInterface $hydrator = null);
}
