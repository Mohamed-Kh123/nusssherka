<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class BaseModel extends Model
{
    use HasFactory;

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $path = storage_path("app/public/uploads/images/$this->image");
            $exists = File::exists($path);
            if (!$exists) {
                return asset('storage/null.jpg');
            }

            $image = Image::make($path);

            $response = Response::make($image->encode($image->mime), 200);
            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $image->mime);

            // Generate a URL for the image
            return asset("storage/uploads/images/$this->image");
        }
        return asset('storage/null.jpg');
    }
}
