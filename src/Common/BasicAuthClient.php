<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

use IBM\Watson\Common\HttpClient\Builder;
use IBM\Watson\Common\Util\DiscoveryTrait;

/**
 * Service client which uses username and password to authenticate with the API.
 */
class BasicAuthClient extends AbstractClient implements BasicAuthClientInterface
{
    use DiscoveryTrait;

    /**
     * Create configured client using username and password.
     *
     * @param string $username API username.
     * @param string $password API password.
     *
     * @return \IBM\Watson\Common\BasicAuthClient
     */
    public static function create(string $username, string $password): BasicAuthClientInterface
    {
        $httpClient = (new Builder())
            ->withCredentials($username, $password)
            ->createConfiguredClient();

        return new self($httpClient);
    }
}
