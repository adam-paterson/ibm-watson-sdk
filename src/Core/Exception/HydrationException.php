<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Exception;

use RuntimeException;

/**
 * Exception thrown if an error occurs while hydrating response.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class HydrationException extends RuntimeException implements WatsonExceptionInterface
{
}
