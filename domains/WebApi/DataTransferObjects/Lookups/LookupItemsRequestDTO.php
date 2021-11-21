<?php

namespace WebApi\DataTransferObjects\Lookups;

use App\Helpers\ArrayExtended;
use App\Helpers\DateTimeExtended;
use App\Helpers\StorageExtended;
use App\Helpers\StrExtended;
use App\Http\Responses\IJSONResponse;
use WebApi\Database\Models\VehicleMake;

class LookupItemsRequestDTO implements IJSONResponse
{
    public ?int $length;
    public ?int $page;
    public ?int $offset;
    public ?int $is_active;
    public ?int $is_archived;

    public function __construct(
        ?int $length,
        ?int $page,
        ?int $offset,
        ?int $is_active,
        ?int $is_archived
    ) {
        $this->length = isset($length) && !is_null($length) && $length > 0 ? $length : 50;
        $this->page = isset($page) && !is_null($page) && $page > 0 ? $page : 1;
        $this->offset = isset($offset) && !is_null($offset) && $offset >= 0 ? $offset : (($this->page - 1) * $this->length);
        $this->is_active = isset($is_active) && !is_null($is_active) && $is_active >= 0 ? $is_active : 1;
        $this->is_archived = isset($is_archived) && !is_null($is_archived) && $is_archived > 0 ? $is_archived : 0;
    }

    public function toJSONResponse(): array
    {
        return ArrayExtended::filterNulls([
            'length' => $this->length,
            'page' => $this->page,
            'offset' => $this->offset,
            'is_active' => $this->is_active,
            'is_archived' => $this->is_archived
        ]);
    }
}