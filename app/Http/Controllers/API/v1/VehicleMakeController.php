<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\v1;

use App\Enums\Http\StatusCode;
use App\Helpers\StorageExtended;
use App\Http\Controllers\Controller;
use App\Http\Responses\AssociativeArrayResponseDTO;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use WebApi\Database\Models\VehicleMake;
use WebApi\Requests\Lookups\LookupItemsRequest;
use WebApi\Requests\Lookups\VehicleMakeItemRequest;
use WebApi\Services\Lookups\BasicSetupsService;

class VehicleMakeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ["except" => ["index"]]);
    }
    /**
     * @return JsonResponse
     *
     * */
    public function index(LookupItemsRequest $request): JsonResponse
    {
        $itemsRequestDTO = $request->getItem();

        return $this->handleResponse(BasicSetupsService::processGetListRequest(VehicleMake::class, $itemsRequestDTO));
    }
    /**
     * @return JsonResponse
     *
     * */
    public function store(VehicleMakeItemRequest $request): JsonResponse
    {
        $vehicleMakeDTO = $request->getItem();

        return $this->handleResponse(BasicSetupsService::processStoreRequest(VehicleMake::class, $vehicleMakeDTO->toJSONResponse()));
    }

    /**
     * @return JsonResponse
     *
     * */
    public function update(VehicleMakeItemRequest $request, $id): JsonResponse
    {
        $vehicleMakeDTO = $request->getItem();

        return $this->handleResponse(BasicSetupsService::processUpdateRequest(VehicleMake::class, $vehicleMakeDTO, ["id" => $id]));
    }
}
