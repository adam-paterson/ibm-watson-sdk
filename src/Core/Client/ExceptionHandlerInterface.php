<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception handler client interface.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
interface ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response);
}
