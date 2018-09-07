<?php

namespace spec\IBM\Watson\Common\stubs;

use Http\Client\HttpClient;
use http\Env\Response;
use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\Common\stubs\Api;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApiSpec extends ObjectBehavior
{
    function let(
        HttpClient $httpClient,
        HydratorInterface $hydrator,
        RequestBuilder $requestBuilder
    ) {
        $this->beConstructedWith(
            $httpClient,
            $hydrator,
            $requestBuilder
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Api::class);
        $this->shouldHaveType(AbstractApi::class);
    }
}
