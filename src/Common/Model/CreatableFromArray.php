<?php

namespace IBM\Watson\Common\Model;

/**
 * Interface for models which can be creted from an array.
 */
interface CreatableFromArray
{
    /**
     * @param array $data Data.
     *
     * @return \IBM\Watson\Common\Model\CreatableFromArray
     */
    public static function create(array $data): self;
}
