<?php

declare(strict_types=1);

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\Model\CreatableFromArray;

/**
 * Stub class, does nothing.
 */
class CreatableFromArrayModel implements CreatableFromArray
{
    /**
     * @var string
     */
    private $param;

    /**
     * CreatableFromArray constructor.
     *
     * @param string $param
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\Common\Model\CreatableFromArray
     */
    public static function create(array $data): CreatableFromArray
    {
        return new self($data['param']);
    }

    /**
     * @return string
     */
    public function getParam(): string
    {
        return $this->param;
    }
}
