<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Exception;

/**
 * Exception thrown if an argument does not match with the expected value.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class InvalidArgumentException extends \InvalidArgumentException implements WatsonExceptionInterface
{
}
