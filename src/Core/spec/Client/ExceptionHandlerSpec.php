<?php

namespace spec\IBM\Watson\Core\Client;

use Http\Client\Exception\HttpException;
use IBM\Watson\Core\Client\ExceptionHandler;
use IBM\Watson\Core\Client\ExceptionHandlerInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ExceptionHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExceptionHandler::class);
        $this->shouldImplement(ExceptionHandlerInterface::class);
    }

    function it_throws_bad_request_exception_when_status_code_is_400(
        RequestInterface $request,
        ResponseInterface $response,
        StreamInterface $body
    ) {
        $response
            ->getStatusCode()
            ->willReturn(400);

        $response
            ->getBody()
            ->willReturn($body);

        $response
            ->getReasonPhrase()
            ->willReturn('Invalid JSON input at line 1, column 2');

        $body
            ->getContents()
            ->willReturn('{"code": 400, "sub_code": "C00012", "error": "Invalid JSON input at line 1, column 2"}');

        $request
            ->getRequestTarget()
            ->willReturn('https://api.example.com');

        $request
            ->getMethod()
            ->willReturn('GET');

        $this
            ->shouldThrow(HttpException::create($request->getWrappedObject(), $response->getWrappedObject()))
            ->during('handle', [$request, $response]);
    }
}
