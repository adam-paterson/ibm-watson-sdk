<?php
/**
 * Abstract Tone Request class
 */
namespace IBM\Watson\ToneAnalyzer\Message;

use IBM\Watson\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Tone Request class
 * @see BaseAbstractRequest
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Default API version
     */
    const DEFAULT_VERSION = '2016-05-19';

    /**
     * @var string
     */
    protected $endpoint = 'https://gateway.watsonplatform.net/tone-analyzer/api/v3';

    /**
     * Get API version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->getParameter('version', self::DEFAULT_VERSION);
    }

    /**
     * Set API version
     *
     * @param string $value
     * @return $this
     */
    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }

    /**
     * Get request text to analyze
     *
     * @return string
     */
    public function getText()
    {
        return $this->getParameter('text');
    }

    /**
     * Set request text to analyze
     *
     * @param string $value
     * @return $this
     */
    public function setText($value)
    {
        return $this->setParameter('text', $value);
    }
}
