<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($file, $deleteImage = false, $fileName = null) {

        if (!empty($deleteImage)) {
            $this->removeImage($deleteImage);
        }

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

    public function removeImage($path){
        if(file_exists(public_path($path))){
            unlink(public_path($path));
        }
    }
}
