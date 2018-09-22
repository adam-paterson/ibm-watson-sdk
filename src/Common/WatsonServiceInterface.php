<?php

declare(strict_types=1);

namespace IBM\Watson\Common;

use Http\Message\Authentication;

interface WatsonServiceInterface
{
    /**
     * @param \Http\Message\Authentication $authentication
     *
     * @return \IBM\Watson\Common\WatsonServiceInterface
     */
    public static function create(Authentication $authentication): self;
}
