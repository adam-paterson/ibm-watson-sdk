<?php

namespace IBM\Watson\VisualRecognition\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class Image implements ApiResponseInterface
{
    /**
     * @var array
     */
    private $classifiers;

    /**
     * @var string
     */
    private $resolvedUrl;

    /**
     * @var string
     */
    private $sourceUrl;

    /**
     * Image constructor.
     *
     * @param array     $classifiers
     * @param string    $resolvedUrl
     * @param string    $sourceUrl
     */
    public function __construct(array $classifiers, $resolvedUrl, $sourceUrl)
    {
        $this->classifiers = $classifiers;
        $this->resolvedUrl = $resolvedUrl;
        $this->sourceUrl = $sourceUrl;
    }

    /**
     * Create image
     *
     * @param array $data
     *
     * @return \IBM\Watson\VisualRecognition\Model\Image
     */
    public static function create(array $data)
    {
        $classifiers = [];

        foreach ($data['classifiers'] as $classifier) {
            $classifiers[] = Classifier::create($classifier);
        }

        return new self($classifiers, $data['resolved_url'], $data['source_url']);
    }

    /**
     * @return array
     */
    public function getClassifiers()
    {
        return $this->classifiers;
    }

    /**
     * @return string
     */
    public function getResolvedUrl()
    {
        return $this->resolvedUrl;
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }
}
