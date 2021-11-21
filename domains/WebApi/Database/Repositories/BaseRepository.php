<?php

namespace WebApi\Database\Repositories;

abstract class BaseRepository
{
    public static function factoryAdd($className, $data, $where = []){
        $added = false;
        if(!is_null($className))
        {
            $model = (new \ReflectionClass($className))->newInstanceWithoutConstructor();
            if(is_array($where) && count($where) > 0)
            {
                $added = $model->createOrUpdate($where, $data);
            }
            else
            {
                $added = $model->create($data);
            }
        }
        return json_decode(json_encode($added), true);
    }
    public static function factoryUpdate($className, $data, $where){
        $updated = false;
        if(!is_null($className))
        {
            $model = (new \ReflectionClass($className))->newInstanceWithoutConstructor();
            if(is_array($where) && count($where) > 0)
            {
                $updated = $model->where($where)->update($data);
            }
        }
        return ["where" => $where, "updated" => $updated];
    }
    public static function factoryDelete($className, $where, $softDeleteColumn = "is_archived", $softDelete = true){
        $updated = false;
        if(!is_null($className))
        {
            $model = (new \ReflectionClass($className))->newInstanceWithoutConstructor();
            if(is_array($where) && count($where) > 0)
            {
                if($softDelete)
                {
                    $updated = $model->where($where)->update([$softDeleteColumn => 1]);
                }
                else
                {
                    $updated = $model->where($where)->delete();
                }
            }
        }
        return ["where" => $where, "deleted" => $updated];
    }
    public static function factoryGet($className, $where, $skip = 0, $take = 1000){
        $data = false;
        if(!is_null($className))
        {
            $model = (new \ReflectionClass($className))->newInstanceWithoutConstructor();
            if(is_array($where) && count($where) > 0)
            {
                $data = $model->where($where)->skip($skip)->take($take)->get();
            }
        }
        return json_decode(json_encode($data), true);
    }


}