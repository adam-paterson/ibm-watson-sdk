<?php

namespace spec\IBM\Watson\Core\Client\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Message\Authentication;
use Http\Message\RequestFactory;
use Http\Message\UriFactory;
use IBM\Watson\Core\Client\HttpClient\Builder;
use PhpSpec\ObjectBehavior;

class BuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Builder::class);
    }

    function it_builds_http_client_stack()
    {
        $this->create()->shouldReturnAnInstanceOf(HttpMethodsClient::class);
    }

    function it_builds_http_client_with_authentication(Authentication $authentication)
    {
        $this->withAuthentication($authentication)->shouldReturn($this);
    }

    function it_sets_http_client_when_provided(HttpClient $httpClient)
    {
        $this->setHttpClient($httpClient)->shouldReturn($this);
    }

    function it_sets_request_factory_when_provided(RequestFactory $requestFactory)
    {
        $this->setRequestFactory($requestFactory)->shouldReturn($this);
    }

    function it_sets_uri_factory_when_provided(UriFactory $uriFactory)
    {
        $this->setUriFactory($uriFactory)->shouldReturn($this);
    }

    function it_sets_default_host_when_provided()
    {
        $this->withHost('http://example.com/api')->shouldReturn($this);
    }
}
