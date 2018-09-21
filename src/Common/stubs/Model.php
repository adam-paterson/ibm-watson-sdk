<?php

declare(strict_types=1);

namespace IBM\Watson\Common\stubs;

/**
 * Stub class, does nothing.
 */
class Model
{
    /**
     * @var string
     */
    private $params;

    /**
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }
}
