<?php

namespace WebApi\Database\Repositories;

class BasicSetupRepository extends BaseRepository
{
    public static function list($className, $where)
    {
        $reflection = new \Reflection($className);
        return $reflection->where($where)->get();
    }
}