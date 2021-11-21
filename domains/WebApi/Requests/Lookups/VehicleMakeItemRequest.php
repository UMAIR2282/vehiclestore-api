<?php

declare(strict_types=1);

namespace WebApi\Requests\Lookups;

use WebApi\DataTransferObjects\Lookups\VehicleMakeDTO;
use WebApi\Requests\BaseApiRequest;

final class VehicleMakeItemRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'short_code' => 'required|string',
            'short_description' => 'nullable|string',
            'year_ranges' => 'nullable|array',
            'primary_logo_path' => 'nullable|string',
            'primary_image_path' => 'nullable|string',
            'is_active' => 'nullable|integer',
            'is_archived' => 'nullable|integer',
            'created_at' => 'nullable|string',
            'updated_at' => 'nullable|string'
        ];
    }

    /**
     * @return VehicleMakeDTO
     */
    public function getItem(): VehicleMakeDTO
    {
        $id = (int) $this->get('id');
        $name = $this->get('name');
        $short_code = $this->get('short_code');
        $short_description = $this->get('short_description');
        $year_ranges = (array) $this->get('year_ranges');
        $primary_logo_path = $this->get('primary_logo_path');
        $primary_image_path = $this->get('primary_image_path');
        $is_active = (int) $this->get('is_active');
        $is_archived = (int) $this->get('is_archived');
        $images = [];
        $created_at = $this->get('created_at');
        $updated_at = $this->get('updated_at');

        if(isset($this->files) && $this->files != null && count($this->files) > 0)
        {
            foreach($this->files AS $file)
            {
                $images[] = $file;
            }
        }

        return new VehicleMakeDTO($id, $name, $short_code, $short_description, $year_ranges, $primary_logo_path, $primary_image_path, $is_active, $is_archived, $images, $created_at, $updated_at);
    }
}