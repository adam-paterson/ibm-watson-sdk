<?php

namespace IBM\Watson\Common\Util;

/**
 * Trait ValidateQueryParams
 */
trait ValidateQueryParams
{
    /**
     * @var array
     */
    protected $allowedParams;

    /**
     * @param array $params
     *
     * @return array
     */
    private function validateQueryParams(array $params)
    {
        return array_filter($params, function ($param) {
            return in_array($param, $this->allowedParams, true);
        }, ARRAY_FILTER_USE_KEY);
    }
}
