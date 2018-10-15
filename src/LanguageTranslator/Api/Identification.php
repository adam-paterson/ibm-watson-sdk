<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Api;

use IBM\Watson\Core\Api\AbstractApi;

/**
 * Identification.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class Identification extends AbstractApi
{
    const API_URI_LIST     = 'v3/identifiable_languages';
    const API_URI_IDENTIFY = 'v3/identify';

    /**
     * Lists the languages that the service can identify.
     * Returns the language code (for example, `en` for English or `es` for Spanish) and name of each language.
     *
     * @return mixed
     * @throws \Http\Client\Exception
     */
    public function list()
    {
        return $this->hydrator->hydrate(
            $this->httpClient->get(self::API_URI_LIST)
        );
    }

    /**
     * Identifies the language of the input text.
     *
     * @param string $text
     *
     * @return mixed
     * @throws \Http\Client\Exception
     */
    public function identify(string $text)
    {
        return $this->hydrator->hydrate(
            $this->httpClient->post(self::API_URI_IDENTIFY, [], $text)
        );
    }

    /**
     * @return array
     */
    public function getAllowedParameters(): array
    {
        return [];
    }
}
