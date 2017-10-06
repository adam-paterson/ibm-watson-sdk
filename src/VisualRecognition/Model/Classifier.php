<?php

namespace IBM\Watson\VisualRecognition\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;
use IBM\Watson\VisualRecognition\Model\Classifier\Classification;

class Classifier implements ApiResponseInterface
{
    /**
     * @var array
     */
    private $classes;

    /**
     * @var string
     */
    private $classifierId;

    /**
     * @var string
     */
    private $name;

    /**
     * Classifier constructor.
     *
     * @param $classes
     * @param $classifierId
     * @param $name
     */
    public function __construct($classes, $classifierId, $name)
    {
        $this->classes = $classes;
        $this->classifierId = $classifierId;
        $this->name = $name;
    }

    /**
     * Create Classifier
     *
     * @param array $data
     *
     * @return \IBM\Watson\VisualRecognition\Model\Classifier
     */
    public static function create(array $data)
    {
        $classes = [];

        foreach ($data['classes'] as $class) {
            $classes[] = Classification::create($class);
        }

        return new self($classes, $data['classifier_id'], $data['name']);
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @return string
     */
    public function getClassifierId()
    {
        return $this->classifierId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
