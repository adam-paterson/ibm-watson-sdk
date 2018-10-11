<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Api;

use IBM\Watson\Core\Api\AbstractApi;

class Identification extends AbstractApi
{
    const API_URI_LIST = 'v3/identifiable_languages';

    public function list()
    {
        return $this->hydrator->hydrate(
            $this->httpClient->get(self::API_URI_LIST)
        );
    }

    /**
     * @return array
     */
    public function getAllowedParameters(): array
    {
        // TODO: Implement getAllowedParameters() method.
    }
}
