<?php
/**
 * Tone Request class
 */

namespace IBM\Watson\ToneAnalyzer\Message;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

/**
 * Tone Request class
 *
 * This request class provides the required functions to
 * interact with the IBM Watson Tone Analyzer service
 *
 * @see AbstractRequest
 */
class ToneRequest extends AbstractRequest
{
    /**
     * Get request data
     *
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();
        $data['version'] = $this->getVersion();
        $data['text'] = $this->getText();

        return $data;
    }

    /**
     * Send request data
     *
     * @param array $data
     * @return ToneResponse
     */
    public function sendData($data)
    {
        $request = new Request(
            'GET',
            $this->endpoint . '?' . http_build_query(['version' => $this->getVersion(), 'text' => $this->getText()]),
            ['Authorization' => 'Basic ' . base64_encode($data['username'] . ':' . $data['password'])]
        );

        try {
            $response = $this->httpClient->send($request);
        } catch (ClientException $e) {
        }

        return $this->response = new ToneResponse($this, $response->getBody());
    }
}
