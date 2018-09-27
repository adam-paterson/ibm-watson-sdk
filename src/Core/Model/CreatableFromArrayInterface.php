<?php

namespace IBM\Watson\Core\Model;

interface CreatableFromArrayInterface
{
    const METHOD_CREATE = 'create';

    public static function create(array $data);
}
