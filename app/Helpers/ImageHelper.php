<?php
namespace App\Helpers;

use DataTables;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function uploadImage($file, $fileName = null) {
        $image = $file;
        if(empty($fileName)){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
        } else {
            $image_name = $fileName . '.' . $image->getClientOriginalExtension();
        }
        $directory = 'uploads/';
        $path = public_path($directory . $image_name);

        Image::make($image->getRealPath())->orientate()->save($path);

        return $directory . $image_name;
    }

    public static function removeImage($path){
        if(file_exists(public_path($path))){
            unlink(public_path($path));
        }
    }

    public static function updateImage($file, $path, $fileName = null){
        self::removeImage($path);
        return self::uploadImage($file, $fileName);
    }
}
