<?php
/**
 * Request Interface
 */

namespace IBM\Watson\Common\Message;

/**
 * Request Interface
 *
 * This interface class defines the standard functions that any Watson request
 * interface needs to be able to provide. It is an extension of MessageInterface.
 *
 * @see MessageInterface
 */
interface RequestInterface extends MessageInterface
{
    /**
     * Initialize request with parameters
     *
     * @param array $parameters
     */
    public function initialize(array $parameters = []);

    /**
     * Get all the request parameters
     *
     * @return array
     */
    public function getParameters();

    /**
     * Get the response to this request
     *
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * Send the request
     *
     * @return ResponseInterface
     */
    public function send();

    /**
     * Send the request with data
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data);
}
