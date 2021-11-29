<?php

declare(strict_types=1);

namespace WebApi\Services\Lookups;

use App\Helpers\StorageExtended;
use App\Http\Responses\IJSONResponse;
use Lookups\Models\LookupsBaseModel;

class ProcessImagesAction
{
    public LookupsBaseModel $lookup;
    public IJSONResponse $dto;

    public function __construct(LookupsBaseModel $model, IJSONResponse $dto = null)
    {
        $this->lookup = $model;
        $this->dto = $dto;
    }

    public function __invoke(array $images = [], IJSONResponse $dto)
    {
        if(isset($dto->id) && is_array($images) && count($images) > 0)
        {
            foreach($images AS $image)
            {
                StorageExtended::storeImage($image, "./basicsetups/".get_class($this->lookup)."/".$dto->id."/");
            }
        }
    }
}