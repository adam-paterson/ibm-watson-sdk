<?php

namespace spec\IBM\Watson\Common;

use Http\Client\HttpClient;
use IBM\Watson\Common\AbstractClient;
use IBM\Watson\Common\BasicAuthClient;
use PhpSpec\ObjectBehavior;

class BasicAuthClientSpec extends ObjectBehavior
{
    public function setUp(HttpClient $httpClient)
    {
        $this->beConstructedWith($httpClient);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BasicAuthClient::class);
        $this->shouldHaveType(AbstractClient::class);
    }

    public function it_should_create_client()
    {
        $this::create('username', 'password')->shouldReturnAnInstanceOf(BasicAuthClient::class);
    }

    public function it_should_discover_http_client()
    {
        $this::create('username', 'password')
            ->discoverHttpClient()
            ->shouldReturnAnInstanceOf(HttpClient::class);
    }
}
