<?php

namespace IBM\Watson\Common\stubs;

use IBM\Watson\Common\Api\AbstractApi;

/**
 * Stub Class, does nothing
 */
class Api extends AbstractApi
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function getMethod()
    {
        $response = $this->get('/api', [
            'param' => 'value'
        ]);

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function postMethod()
    {
        $response = $this->post('/api');

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function postRawMethod()
    {
        $response = $this->postRaw('/api', 'body');

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function putMethod()
    {
        $response = $this->put('/api');

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function patchMethod()
    {
        $response = $this->patch('/api');

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     * @throws \IBM\Watson\Common\Exception\Api\BadRequestException
     * @throws \IBM\Watson\Common\Exception\Domain\InsufficientPrivilegesException
     * @throws \IBM\Watson\Common\Exception\Domain\NotFoundException
     * @throws \IBM\Watson\Common\Exception\Domain\UnknownErrorException
     */
    public function deleteMethod()
    {
        $response = $this->delete('/api');

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }

    /**
     * @return \IBM\Watson\Common\Api\AbstractApi
     */
    protected function setAllowedParams()
    {
        $this->allowedParams = [
            'param'
        ];

        return $this;
    }
}
