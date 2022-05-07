<?php

namespace App\Traits;
use Illuminate\Support\Facades\Validator;


trait ValidationEngine
{
    public function validate_product($input){
        return Validator::make($input, [
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'image' => ['required','mimes:jpeg,png,bmp'],
        ]);
    }
}
