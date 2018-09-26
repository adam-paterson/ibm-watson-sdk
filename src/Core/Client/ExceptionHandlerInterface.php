<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ExceptionHandlerInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response);
}
