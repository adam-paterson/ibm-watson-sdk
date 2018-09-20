<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

/**
 * Basic auth service client interface.
 */
interface BasicAuthClientInterface
{
    /**
     * Create configured client using username and password.
     *
     * @param string $username API username.
     * @param string $password API password.
     *
     * @return self
     */
    public static function create(string $username, string $password): self;
}
