<?php

declare(strict_types=1);

namespace IBM\Watson\Core\Api;

abstract class AbstractApi implements ApiInterface
{
    public function validateParameters(array $parameters = []): array
    {
        return array_filter($parameters, function ($parameter) {
            return \in_array($parameter, $this->getAllowedParameters(), true);
        }, ARRAY_FILTER_USE_KEY);
    }
}
