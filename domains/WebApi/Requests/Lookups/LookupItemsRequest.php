<?php

declare(strict_types=1);

namespace WebApi\Requests\Lookups;

use WebApi\DataTransferObjects\Lookups\LookupItemsRequestDTO;
use WebApi\Requests\BaseApiRequest;

final class LookupItemsRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'length' => 'nullable|integer',
            'page' => 'nullable|integer',
            'offset' => 'nullable|integer',
            'is_active' => 'nullable|integer',
            'is_archived' => 'nullable|integer'
        ];
    }

    /**
     * @return LookupItemsRequestDTO
     */
    public function getItem(): LookupItemsRequestDTO
    {
        $length = (int) $this->get('length');
        $page = (int) $this->get('page');
        $offset = (int) $this->get('offset');
        $is_active = (int) $this->get('is_active');
        $is_archived = (int) $this->get('is_archived');

        return new LookupItemsRequestDTO($length, $page, $offset, $is_active, $is_archived);
    }
}