<?php

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\Model\CreateableFromArray;

class CreateableFromArrayModel implements CreateableFromArray
{
    private $param;

    public function __construct($param)
    {
        $this->param = $param;
    }

    public static function create($data)
    {
        return new self($data['param']);
    }
}
