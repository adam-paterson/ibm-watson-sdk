<?php

namespace IBM\Watson\VisualRecognition\tests\Api;

use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use IBM\Watson\Common\Hydrator\HydratorInterface;
use IBM\Watson\Common\Hydrator\ModelHydrator;
use IBM\Watson\Common\RequestBuilder;
use IBM\Watson\VisualRecognition\Api\Classify;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class ClassifyTest extends TestCase
{
    private $httpClient;
    private $hydrator;
    private $requestBuilder;

    public function setUp()
    {
        $this->httpClient = m::mock(HttpClient::class);
        $this->hydrator = m::mock(new ModelHydrator, HydratorInterface::class);
        $this->requestBuilder = new RequestBuilder();
    }

    public static function successResponse()
    {
        return '{
    "custom_classes": 0,
    "images": [
        {
            "classifiers": [
                {
                    "classes": [
                        {
                            "class": "elder statesman",
                            "score": 0.529,
                            "type_hierarchy": "/person/adult/elder statesman"
                        },
                        {
                            "class": "adult",
                            "score": 0.579
                        },
                        {
                            "class": "person",
                            "score": 0.73
                        },
                        {
                            "class": "people",
                            "score": 0.507,
                            "type_hierarchy": "/person/people"
                        },
                        {
                            "class": "male official",
                            "score": 0.502,
                            "type_hierarchy": "/person/male official"
                        },
                        {
                            "class": "leader",
                            "score": 0.501,
                            "type_hierarchy": "/adult/person/leader"
                        },
                        {
                            "class": "sociologist",
                            "score": 0.5,
                            "type_hierarchy": "/person/sociologist"
                        }
                    ],
                    "classifier_id": "default",
                    "name": "default"
                }
            ],
            "resolved_url": "http://www.fillmurray.com/200/500.jpg",
            "source_url": "http://www.fillmurray.com/200/500.jpg"
        }
    ],
    "images_processed": 1
}
';
    }

    public static function errorResponse()
    {
        return '{"error": "Too many images in collection", "code": 400}';
    }

    public function testClassifyImageViaUrl()
    {
        $rawResponse = self::successResponse();

        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(200, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $classifier = new Classify($this->httpClient, $this->hydrator, $this->requestBuilder);

        $response = $classifier->classify('http://www.fillmurray.com/200/500.jpg');

        $this->assertEquals(0, $response->getCustomClassesCount());
        $this->assertEquals(1, $response->getImagesProcessedCount());
        $images = $response->getImages();
        $this->assertNotEmpty($images);
        $firstImage = $images[0];

        $this->assertNotEmpty($firstImage->getClassifiers());
        $this->assertEquals('http://www.fillmurray.com/200/500.jpg', $firstImage->getResolvedUrl());
        $this->assertEquals('http://www.fillmurray.com/200/500.jpg', $firstImage->getSourceUrl());
        $classifiers = $firstImage->getClassifiers();
        $this->assertNotEmpty($classifiers);

        $firstClassifier = $classifiers[0];
        $classes = $firstClassifier->getClasses();
        $this->assertNotEmpty($classes);
        $this->assertEquals('default', $firstClassifier->getClassifierId());
        $this->assertEquals('default', $firstClassifier->getName());

        $firstClass = $classes[0];

        $this->assertEquals('elder statesman', $firstClass->getClass());
        $this->assertEquals(0.529, $firstClass->getScore());
    }

    public function testClassifyFilePath()
    {
        $rawResponse = self::successResponse();

        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(200, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $classifier = new Classify($this->httpClient, $this->hydrator, $this->requestBuilder);

        $response = $classifier->classify('src/VisualRecognition/tests/images/flower.jpg');

        $this->assertEquals(0, $response->getCustomClassesCount());
        $this->assertEquals(1, $response->getImagesProcessedCount());
        $this->assertNotEmpty($response->getImages());
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\InvalidRequestException
     */
    public function testErrors()
    {
        $rawResponse = self::errorResponse();

        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(400, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $classifier = new Classify($this->httpClient, $this->hydrator, $this->requestBuilder);

        $classifier->classify('src/VisualRecognition/tests/images/flower.jpg');
        $classifier->classify('http://someurl.com/image.jpg');
    }

    /**
     * @expectedException \IBM\Watson\Common\Exception\InvalidRequestException
     */
    public function testUrlErrors()
    {
        $rawResponse = self::errorResponse();

        $this->httpClient->shouldReceive('sendRequest')->once()->andReturnUsing(function () use ($rawResponse) {
            return new Response(400, ['Content-Type' => 'application/json'], $rawResponse);
        });

        $classifier = new Classify($this->httpClient, $this->hydrator, $this->requestBuilder);

        $classifier->classify('http://someurl.com/image.jpg');
    }
}
