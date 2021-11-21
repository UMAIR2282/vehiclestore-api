<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageExtended
{
    public static function getDisk()
    {
        return Storage::disk(self::getDiskType());
    }

    public static function getDiskType()
    {
        $cloud = config('filesystems.cloud');
        $default = config('filesystems.default');
        if ($default == "local") {
            return $default;
        } else {
            return $cloud;
        }

    }

    public static function getUrl($path)
    {
        $disk = self::getDisk();
        return $disk->url($path);
    }

    public static function storeImage($image, $path, $name = null)
    {
        $disk = self::getDisk();
        if(!isset($name))
        {
            $name = $image->getClientOriginalName( );
        }
        return $disk->put($path.$name, file_get_contents($image->getRealPath()));
    }
}