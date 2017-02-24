<?php
/**
 * Tone Analyzer Service class
 */
namespace IBM\Watson\ToneAnalyzer;

use IBM\Watson\Common\AbstractService;
use IBM\Watson\ToneAnalyzer\Message\ToneRequest;

/**
 * Tone Analyzer Service class
 *
 * This class provides and interface for interacting with the
 * IBM Watson Tone Analyzer service
 *
 * @link https://www.ibm.com/watson/developercloud/tone-analyzer.html
 * @see AbstractService
 */
class Service extends AbstractService
{
    /**
     * Get service name
     *
     * @return string
     */
    public function getName()
    {
        return 'Tone Analyzer';
    }

    /**
     * Get API version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->getParameter('version');
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
     * Analyze tone
     *
     * @param array $parameters
     * @return \IBM\Watson\Common\Message\AbstractRequest
     */
    public function tone(array $parameters = [])
    {
        return $this->createRequest(ToneRequest::class, $parameters);
    }
}
