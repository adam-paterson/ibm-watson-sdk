<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Api;

use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\LanguageTranslator\Model\TranslationModels;

final class Models extends AbstractApi
{
    const API_URI = 'v3/models';

    public function getAllowedParameters(): array
    {
        return [];
    }

    public function list()
    {
        return $this->hydrator->hydrate(
            $this->httpClient->get(static::API_URI),
            TranslationModels::class
        );
    }
}
