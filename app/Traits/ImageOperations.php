<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageOperations
{

    use Response;

    public function uploadImage($request)
    {
        if ($request->hasFile('image')) {

            $image = $this->generateImageUniqueName($request->file('image'));

            $destination_path = './upload/product/';

            if ($request->file('image')->move($destination_path, $image)) {
                $imageLink = '/upload/product/' . $image;
                return ['status' => 'success', 'data' => $imageLink];
            } else {
                return ['status' => 'error', 'errorMessage' => 'Sorry we cannot upload this image'];
            }
        } else {
            return ['status' => 'error', 'errorMessage' => 'Image not found!'];
        }
    }

    protected function generateImageUniqueName($inputFile)
    {
        $original_filename = $inputFile->getClientOriginalName();
        $original_filename_arr = explode('.', $original_filename);
        $file_ext = end($original_filename_arr);
        $imageName = 'P-' . time() . '.' . $file_ext;

        return $imageName;
    }

    public function removeImage($image_link)
    {
        $image_path=app()->basePath('public').'/'.$image_link;
        
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
    }
}
