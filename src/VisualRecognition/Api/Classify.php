<?php

namespace IBM\Watson\VisualRecognition\Api;

use IBM\Watson\Common\Api\AbstractApi;
use IBM\Watson\VisualRecognition\Model\ClassifiedImages;

class Classify extends AbstractApi
{
    /**
     * Classify image
     *
     * @param string|resource $image
     * @param array           $params
     *
     * @return \IBM\Watson\VisualRecognition\Model\ClassifiedImages
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function classify($image, $params = [])
    {
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            $response = $this->classifyUrl($image, $params);
        }

        if (file_exists($image)) {
            $image = fopen($image, 'r');
        }

        if (is_resource($image)) {
            $params[] = [
                'name' => 'images_file',
                'content' => $image
            ];

            $response = $this->postRaw('/v3/classify', $params);
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ClassifiedImages::class);
    }

    /**
     * Classify image by url
     *
     * @param string $url
     * @param array  $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function classifyUrl($url, $params = [])
    {
        $params['url'] = $url;

        $response = $this->get('/v3/classify', $params);

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $response;
    }
}
