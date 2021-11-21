<?php

namespace WebApi\DataTransferObjects\Lookups;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Helpers\StrExtended;
use App\Http\Responses\IJSONResponse;
use WebApi\Database\Models\VehicleMake;

class LookupItemsDTO implements IJSONResponse
{
    public ?array $items;
    public ?int $total;

    public function __construct(
        ?array $items,
        ?int $total = null
    ) {
        $this->items = $items;
        $this->total = $total;
    }

    public static function fromDBModel($items): self
    {
        return new self(
            json_decode(json_encode($items), true)
        );
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'items' => $this->items,
            'total' => $this->total
        ]);
    }
}