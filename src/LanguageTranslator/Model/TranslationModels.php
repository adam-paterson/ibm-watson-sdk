<?php

namespace IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;

class TranslationModels implements CreatableFromArrayInterface
{
    const KEY_MODELS = 'models';

    private $models = [];

    /**
     * TranslationModels constructor.
     *
     * @param array $models
     */
    public function __construct(array $models)
    {
        $this->models = $models;
    }

    public static function create(array $data)
    {
        $models = [];

        foreach ($data[static::KEY_MODELS] as $model) {
            $models[] = TranslationModel::create($model);
        }

        return new self($models);
    }

    public function getModels()
    {
        return $this->models;
    }
}
