<?php
/**
 * Response Interface
 */
namespace IBM\Watson\Common\Message;

/**
 * Response Interface
 *
 * This interface class defines the standard functions that any Watson response
 * interface needs to be able to provide. It is an extension of MessageInterface
 *
 * @see MessageInterface
 */
interface ResponseInterface extends MessageInterface
{
    /**
     * Get the origin request which created this response
     *
     * @return RequestInterface
     */
    public function getRequest();

    /**
     * Response code
     *
     * @return null|string A response code from the service API
     */
    public function getCode();
}
