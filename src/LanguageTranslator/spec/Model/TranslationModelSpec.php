<?php

namespace spec\IBM\Watson\LanguageTranslator\Model;

use IBM\Watson\Core\Model\CreatableFromArrayInterface;
use IBM\Watson\LanguageTranslator\Model\TranslationModel;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslationModelSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'en-nl',
            'en-nl',
            'en',
            'nl',
            '',
            'general',
            true,
            true,
            '',
            'available'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TranslationModel::class);
        $this->shouldImplement(CreatableFromArrayInterface::class);
    }

    function it_exposes_model_id()
    {
        $this->getId()->shouldBeString();
    }

    function it_exposes_model_name()
    {
        $this->getName()->shouldBeString();
    }

    function it_exposes_source()
    {
        $this->getSource()->shouldBeString();
    }

    function it_exposes_target()
    {
        $this->getTarget()->shouldBeString();
    }

    function it_exposes_base_model_id()
    {
        $this->getBaseId()->shouldBeString();
    }

    function it_exposes_domain()
    {
        $this->getDomain()->shouldBeString();
    }

    function it_exposes_if_model_is_customizable()
    {
        $this->canCustomize()->shouldBeBool();
    }

    function it_exposes_if_model_is_default()
    {
        $this->isDefaultModel()->shouldBeBool();
    }

    function it_exposes_model_owner()
    {
        $this->getOwner()->shouldBeString();
    }

    function it_exposes_status()
    {
        $this->getStatus()->shouldBeString();
    }
}
