<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Api;

/**
 * Interface
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
interface ApiInterface
{
    /**
     * @return array
     */
    public function getAllowedParameters(): array;

    /**
     * @return array
     */
    public function validateParameters(): array;
}
