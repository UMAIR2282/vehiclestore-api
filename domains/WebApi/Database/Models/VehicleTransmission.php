<?php

namespace WebApi\Database\Models;

class VehicleTransmission extends BaseModel
{
    protected $fillable = ['name', 'short_code', 'short_description', 'primary_logo_path', 'primary_image_path', 'is_active', 'is_archived', 'created_at', 'updated_at'];
    protected $table = "vehicle_transmissions";
}