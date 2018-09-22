<?php

namespace IBM\Watson\ToneAnalyzer\Tests;

use Http\Message\Authentication\BasicAuth;
use IBM\Watson\Common\Tests\AbstractTestCase;
use IBM\Watson\ToneAnalyzer\Api\Tone;
use IBM\Watson\ToneAnalyzer\Service;

class ServiceTest extends AbstractTestCase
{
    public function testTone()
    {
        $service = new Service($this->httpClient, $this->hydrator, $this->requestBuilder);

        $this->assertInstanceOf(Tone::class, $service->tone());
    }

    public function testCreate()
    {
        $basicAuth = new BasicAuth('username', 'password');
        $service = Service::create($basicAuth);

        $this->assertInstanceOf(Service::class, $service);
    }
}
