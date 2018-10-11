<?php

declare(strict_types=1);

namespace IBM\Watson\Core\stubs;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

/**
 * Stub class, does nothing.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class CreatableFromArrayModel implements CreatableFromArrayInterface
{
    private $param;

    private $param2;

    /**
     * CreatableFromArrayModel constructor.
     *
     * @param $param
     * @param $param2
     */
    public function __construct($param, $param2)
    {
        $this->param  = $param;
        $this->param2 = $param2;
    }

    public static function create(array $data)
    {
        return new self($data['param'], $data['param2']);
    }
}
