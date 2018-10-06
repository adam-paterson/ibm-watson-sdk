<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Model;

/**
 * Interface for classes which can be created from array.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
interface CreatableFromArrayInterface
{
    const METHOD_CREATE = 'create';

    /**
     * @param array $data
     *
     * @return self
     */
    public static function create(array $data);
}
