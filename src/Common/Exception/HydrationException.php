<?php

declare(strict_types=1);

namespace IBM\Watson\Common\Exception;

use RuntimeException;
use IBM\Watson\Common\Exception;

/**
 * Exception to be thrown during hydration.
 */
class HydrationException extends RuntimeException implements Exception
{
}
