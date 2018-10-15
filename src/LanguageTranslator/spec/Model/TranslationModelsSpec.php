<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\LanguageTranslator\Model\TranslationModel;
use IBM\Watson\LanguageTranslator\Model\TranslationModels;
use PhpSpec\ObjectBehavior;

class TranslationModelsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['models' => []]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TranslationModels::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_available_translation_models()
    {
        $this->getModels()->shouldBeArray();
    }

    function it_creates_self()
    {
        $data = [
            TranslationModels::KEY_MODELS => [
                [
                    TranslationModel::KEY_ID => 'en-nl',
                    TranslationModel::KEY_NAME => 'en-nl',
                    TranslationModel::KEY_SOURCE => 'en',
                    TranslationModel::KEY_TARGET => 'nl',
                    TranslationModel::KEY_BASE_ID => '',
                    TranslationModel::KEY_DOMAIN => 'general',
                    TranslationModel::KEY_CUSTOMIZABLE => true,
                    TranslationModel::KEY_DEFAULT => true,
                    TranslationModel::KEY_OWNER => '',
                    TranslationModel::KEY_STATUS => ''
                ]
            ]
        ];

        $this::create($data);
    }
}
