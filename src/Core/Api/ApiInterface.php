<?php

namespace IBM\Watson\Core\Api;

interface ApiInterface
{
    public function getAllowedParameters(): array;

    public function validateParameters(): array;
}
