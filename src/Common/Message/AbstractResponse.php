<?php
/**
 * Abstract Response
 */

namespace IBM\Watson\Common\Message;

/**
 * Abstract Response
 *
 * This abstract class implements ResponseInterface and defines a basic
 * set of functions that all Watson Response are intended to include
 *
 * @see ResponseInterface
 */
abstract class AbstractResponse implements ResponseInterface
{
    /**
     * The embodied request object
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * The data contained in the response
     *
     * @var mixed
     */
    protected $data;

    /**
     * Create a response
     *
     * @param RequestInterface $request The initiating request
     * @param mixed $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * Get the initiating request
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the response data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
