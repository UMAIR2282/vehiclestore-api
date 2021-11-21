<?php

declare(strict_types=1);

namespace WebApi\Services\Lookups;

use App\Enums\Http\StatusCode;
use App\Helpers\StorageExtended;
use App\Http\Responses\AssociativeArrayResponseDTO;
use Illuminate\Session\DatabaseSessionHandler;
use WebApi\Database\Repositories\BasicSetupRepository;
use WebApi\DataTransferObjects\Lookups\LookupItemsRequestDTO;

final class BasicSetupsService
{
    public static function processStoreRequest($className, $data)
    {
        if(isset($data["id"]) && !is_null($data["id"]) && intval($data["id"]) > 0)
        {
            $response = BasicSetupRepository::factoryUpdate($className, $data, ["id" => $data["id"]]);
            $response = ["id" => $data["id"], "update" => $response];
        }
        else
        {
            $response = BasicSetupRepository::factoryAdd($className, $data);
        }
        if(isset($data["images"]))
        {
            self::processImages($className, $response, $data["images"]);
        }
        return new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, "item", $response);
    }

    public static function processImages($className, $response, $images = [])
    {
        if(isset($response["id"]) && is_array($images) && count($images) > 0)
        {
            foreach($images AS $image)
            {
                StorageExtended::storeImage($image, "./basicsetups/$className/".$response["id"]."/");
            }
        }
    }

    public static function processUpdateRequest($className, $data, $where)
    {
        if(is_array($where) && count($where) > 0)
        {
            $response = BasicSetupRepository::factoryUpdate($className, $data, $where);
            $response = ["id" => $data["id"], "update" => $response];
        }
        else
        {
            $response = self::processStoreRequest($className, $data);
        }
        if(isset($data["images"]))
        {
            self::processImages($className, $response, $data["images"]);
        }
        return new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, "item", $response);
    }

    public static function processGetListRequest($className, LookupItemsRequestDTO $itemsRequestDTO)
    {
        $response = BasicSetupRepository::factoryGet($className, ["is_active" => $itemsRequestDTO->is_active, "is_archived" => $itemsRequestDTO->is_archived], $itemsRequestDTO->offset, $itemsRequestDTO->length);
       
        return new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, "items", $response);
    }
}