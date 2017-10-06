<?php

namespace IBM\Watson\VisualRecognition\Model\Classifier;

use IBM\Watson\Common\Model\ApiResponseInterface;

class Classification implements ApiResponseInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var float
     */
    private $score;

    /**
     * Classification constructor.
     *
     * @param $class
     * @param $score
     */
    public function __construct($class, $score)
    {
        $this->class = $class;
        $this->score = $score;
    }

    /**
     * Create Classification
     *
     * @param array $data
     *
     * @return \IBM\Watson\VisualRecognition\Model\Classifier\Classification
     */
    public static function create(array $data)
    {
        return new self($data['class'], $data['score']);
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }
}
