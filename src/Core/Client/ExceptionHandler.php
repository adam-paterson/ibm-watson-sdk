<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Client;

use Http\Client\Exception\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Throws exception based on the response's HTTP status code.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
class ExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response)
    {
        throw HttpException::create($request, $response);
    }
}
