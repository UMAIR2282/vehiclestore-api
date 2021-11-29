<?php

declare(strict_types=1);

namespace WebApi\Services\Lookups;

use App\Enums\Http\StatusCode;
use App\Http\Responses\AssociativeArrayResponseDTO;
use App\Http\Responses\BaseResponseDTO;
use Lookups\DataTransferObjects\LookupItemsRequestDTO;
use Lookups\Models\LookupsBaseModel;

class FetchLookupItemsAction
{
    public LookupsBaseModel $lookup;
    public LookupItemsRequestDTO $dto;

    public function __construct(LookupsBaseModel $model, LookupItemsRequestDTO $dto = null)
    {
        $this->lookup = $model;
        $this->dto = $dto;
    }
    public function __invoke(LookupItemsRequestDTO $itemsRequestDTO = null) : BaseResponseDTO
    {
        $response = $this->lookup->activeList($itemsRequestDTO->offset, $itemsRequestDTO->length);
       
        return new AssociativeArrayResponseDTO(StatusCode::SUCCESS_OK_200, "items", $response);
    }
}