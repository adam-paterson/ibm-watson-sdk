<?php
/**
 * Message Interface
 */

namespace IBM\Watson\Common\Message;

/**
 * Message Interface
 *
 * This interface class defines the standard functions that any Watson message
 * interface needs to be able to provide.
 */
interface MessageInterface
{
    /**
     * Get the raw data array for this message
     *
     * @return mixed
     */
    public function getData();
}
