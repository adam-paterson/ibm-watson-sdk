<?php

declare(strict_types=1);

namespace IBM\Watson\Core;

use Http\Message\Authentication;
use Http\Client\Common\HttpMethodsClient;
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
     * @param \Http\Client\Common\HttpMethodsClient $httpClient
     */
    public function __construct(HttpMethodsClient $httpClient);

    /**
     * @param \Http\Message\Authentication $authentication
     *
     * @param \IBM\Watson\Core\Hydrator\HydratorInterface|null $hydrator
     *
     * @return mixed
     */
    public static function create(Authentication $authentication, HydratorInterface $hydrator = null);
}
