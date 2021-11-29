<?php

namespace Lookups\Actions\Traits;

use App\Http\Responses\IJSONResponse;

trait Updateable
{
    public function updateFromDTO(IJSONResponse $dto, array $whereClause = []) : array{
        $updated = false;
        if(!is_null($this))
        {
            $data = $dto->toJSONResponse();
            if(is_array($whereClause) && count($whereClause) > 0)
            {
                $updated = $this->where($whereClause)->update($data);
            }
        }
        return ["where" => $where, "updated" => $updated];
    }
}