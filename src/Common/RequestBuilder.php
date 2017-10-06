<?php

namespace IBM\Watson\Common;

use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Http\Message\RequestFactory;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

final class RequestBuilder
{
    /**
     * @var \Http\Message\MessageFactory
     */
    private $requestFactory;

    private $multipartStreamBuilder;

    /**
     * RequestBuilder constructor.
     *
     * @param \Http\Message\RequestFactory|null                         $requestFactory
     * @param \Http\Message\MultipartStream\MultipartStreamBuilder|null $multipartStreamBuilder
     */
    public function __construct(
        RequestFactory $requestFactory = null,
        MultipartStreamBuilder $multipartStreamBuilder = null
    ) {
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
        $this->multipartStreamBuilder = $multipartStreamBuilder ?: new MultipartStreamBuilder;
    }

    /**
     * Create a new PSR-7 request
     *
     * @param string                                     $method
     * @param string|UriInterface                        $uri
     * @param array|null                                 $headers
     * @param array|resource|string|StreamInterface|null $body
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function create($method, $uri, array $headers = null, $body = null)
    {
        if (!is_array($body)) {
            $request = $this->requestFactory->createRequest($method, $uri, $headers, $body);
        } else {
            $request = $this->createMultipartStreamRequest($method, $uri, $headers, $body);
        }

        return $request;
    }

    protected function createMultipartStreamRequest($method, $uri, array $headers = [], array $body = [])
    {
        foreach ($body as $item) {
            $name = $item['name'];
            $content = $item['content'];
            unset($item['name'], $item['content']);

            $this->multipartStreamBuilder->addResource($name, $content, $item);
        }

        $multipartStream = $this->multipartStreamBuilder->build();
        $boundary = $this->multipartStreamBuilder->getBoundary();

        $headers['Content-Type'] = 'multipart/form-data; boundary='.$boundary;

        return $this->requestFactory->createRequest($method, $uri, $headers, $multipartStream);
    }
}
