<?php

namespace IBM\Watson\ToneAnalyzer\Message;

use Guzzle\Plugin\Mock\MockPlugin;
use GuzzleHttp\Client;
use IBM\Watson\Common\Tests\TestCase;
use IBM\Watson\ToneAnalyzer\Service;
use Mockery as m;

class ToneRequestTest extends TestCase
{
    protected $request;

    public function testGetData()
    {
        $this->request = m::mock('\IBM\Watson\ToneAnalyzer\Message\ToneRequest')->makePartial();
        $this->request->initialize([
            'username'  => 'adam',
            'password'  => 'password',
            'version'   => '2016-03-01',
            'text'      => 'Test Text',
        ]);

        $this->assertSame([
            'username'  => 'adam',
            'password'  => 'password',
            'version'   => '2016-03-01',
            'text'      => 'Test Text',
        ], $this->request->getData());
    }

    public function testSendSuccess()
    {
        $container = [];

        $response = $this->getMockHttpResponse('ToneRequestSuccess.txt');
        $httpClient = $this->getMockHttpClientWithHistoryAndResponses($container, [$response]);

        $service = new Service($httpClient);
        $service->initialize(['username' => 'adam', 'password' => '123']);

        $request = $service->tone(['text' => 'test text']);
        $request->send();
    }
}
