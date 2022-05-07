<?php

namespace App\Traits;

use Exception;

trait SaveProductDetails
{

    use ValidationEngine, Response, ImageOperations;

    public function saveDetails($product, $request)
    {

        $validation = $this->validate_product($request->all());

        if ($validation->fails()) {

            return $this->errorResponse(['errors' => $validation->errors()->all()], 422);
        }

        if ($product->id) {
            $this->removeImage(($product->image_link));
        }

        $upload_image = $this->uploadImage($request);

        if ($upload_image['status'] == 'error') {
            return $this->errorResponse($upload_image['errorMessage'], 200);
        }


        $image_link = $upload_image['data'];

        try {

            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->image_link = $image_link;
            $product->save();

            return $this->successResponse($product);
        } catch (Exception $error) {
            return $this->errorResponse($error->getMessage(), 200);
        }
    }
}
