<?php


namespace IBM\Watson\Common\Model;

/**
 * Interface CreateableFromArray
 */
interface CreateableFromArray
{
    /**
     * @param array $data
     *
     * @return $this
     */
    public static function create(array $data);
}
