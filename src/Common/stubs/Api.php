<?php

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\Api\AbstractApi;

/**
 * Stub class, does nothing.
 */
class Api extends AbstractApi
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodGet()
    {
        return $this->get('api', [], []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodHead()
    {
        return $this->head('api', []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodTrace()
    {
        return $this->trace('api', []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodPost()
    {
        return $this->post('api', [], []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodPut()
    {
        return $this->put('api', [], []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodPatch()
    {
        return $this->patch('api', '', []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodDelete()
    {
        return $this->delete('api', []);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function httpMethodOptions()
    {
        return $this->options('api', [], []);
    }
}
