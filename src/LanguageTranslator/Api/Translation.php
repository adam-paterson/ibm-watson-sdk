<?php

declare(strict_types=1);

namespace IBM\Watson\LanguageTranslator\Api;

use IBM\Watson\Core\Api\AbstractApi;
use IBM\Watson\Core\Exception\InvalidArgumentException;
use IBM\Watson\LanguageTranslator\Model\TranslationResult;

/**
 * Translation.
 *
 * @author    Adam Paterson <hello@adampaterson.co.uk>
 * @copyright 2018 Adam Paterson
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
final class Translation extends AbstractApi
{
    const API_URI_TRANSLATE = 'v3/translate';
    const PARAM_TEXT        = 'text';
    const PARAM_MODEL_ID    = 'model_id';
    const PARAM_SOURCE      = 'source';
    const PARAM_TARGET      = 'target';

    /**
     * @return array
     */
    public function getAllowedParameters(): array
    {
        return [];
    }

    /**
     * @param string      $text
     * @param string|null $modelId
     * @param string|null $source
     * @param string|null $target
     *
     * @return mixed
     * @throws \Http\Client\Exception
     */
    public function translate(string $text, string $modelId = null, string $source = null, string $target = null)
    {
        if (null === $modelId && null === $source && null === $target) {
            throw new InvalidArgumentException(
                'Either modelId or the combination of source and target must be specified.'
            );
        }

        $body = [
            static::PARAM_TEXT => $text,
        ];

        if ($modelId) {
            $body[static::PARAM_MODEL_ID] = $modelId;
        }

        if ($source && $target) {
            $body[static::PARAM_SOURCE] = $source;
            $body[static::PARAM_TARGET] = $target;
            unset($body[static::PARAM_MODEL_ID]);
        }

        return $this->hydrator->hydrate(
            $this->httpClient->post(static::API_URI_TRANSLATE, [], json_encode($body)),
            TranslationResult::class
        );
    }
}
