<?php

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\AbstractClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCreate()
    {
        $client = Client::create();
        $this->assertInstanceOf(AbstractClient::class, $client);
    }
}
