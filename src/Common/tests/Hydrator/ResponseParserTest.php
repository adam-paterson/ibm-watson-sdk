<?php

namespace IBM\Watson\Common\tests;

use GuzzleHttp\Psr7\Response;
use IBM\Watson\Common\Hydrator\ResponseParser;
use PHPUnit\Framework\TestCase;

class ResponseParserTest extends TestCase
{
    use ResponseParser;

    public function testIsResponseJson()
    {
        $response = new Response(200, ['Content-Type' => 'application/json']);

        $this->assertTrue($this->isResponseJson($response));

        $response = new Response(200, ['Content-Type' => 'text/plain']);

        $this->assertFalse($this->isResponseJson($response));
    }
}
