<?php
/**
 * Tone Response class
 */

namespace IBM\Watson\ToneAnalyzer\Message;

use IBM\Watson\Common\Message\AbstractResponse;

/**
 * Tone Response class
 * @see AbstractResponse
 */
class ToneResponse extends AbstractResponse
{
    /**
     * Get response code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->data->getStatusCode();
    }
}
