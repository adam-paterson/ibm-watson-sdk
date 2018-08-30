<?php

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\AbstractClient;

/**
 * Stub class, does nothing
 */
class Client extends AbstractClient
{
    /**
     * @return \IBM\Watson\Common\stubs\Client
     */
    public static function create()
    {
        return new self();
    }
}
