<?php

namespace IBM\Watson\VisualRecognition\Model;

use IBM\Watson\Common\Model\ApiResponseInterface;

class ClassifiedImages implements ApiResponseInterface
{
    /**
     * @var int
     */
    private $customClassesCount;

    /**
     * @var array
     */
    private $images;

    /**
     * @var int
     */
    private $imagesProcessedCount;

    /**
     * ClassifiedImages constructor.
     *
     * @param $customClassesCount
     * @param $images
     * @param $imagesProcessedCount
     */
    public function __construct($customClassesCount, array $images, $imagesProcessedCount)
    {
        $this->customClassesCount = $customClassesCount;
        $this->images = $images;
        $this->imagesProcessedCount = $imagesProcessedCount;
    }

    /**
     * Create ClassifiedImages
     *
     * @param array $data
     *
     * @return \IBM\Watson\VisualRecognition\Model\ClassifiedImages
     */
    public static function create(array $data)
    {
        $images = [];
        foreach ($data['images'] as $image) {
            $images[] = Image::create($image);
        }

        return new self($data['custom_classes'], $images, $data['images_processed']);
    }

    /**
     * @return int
     */
    public function getCustomClassesCount()
    {
        return $this->customClassesCount;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return int
     */
    public function getImagesProcessedCount()
    {
        return $this->imagesProcessedCount;
    }
}
