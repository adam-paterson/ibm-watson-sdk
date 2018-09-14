<?php


namespace IBM\Watson\Common\tests;

use IBM\Watson\Common\AbstractClient;
use IBM\Watson\Common\stubs\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCreate()
    {
        $client = Client::create();
        $this->assertInstanceOf(AbstractClient::class, $client);
    }
}
