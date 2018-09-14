<?php

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\Model\CreateableFromArray;

/**
 * Stub class, does nothing
 */
class CreateableFromArrayModel implements CreateableFromArray
{
    /**
     * @var string
     */
    private $param;

    /**
     * @param string $param
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    /**
     * @param array $data
     *
     * @return \IBM\Watson\Common\stubs\CreateableFromArrayModel
     */
    public static function create(array $data)
    {
        return new self($data['param']);
    }
}
