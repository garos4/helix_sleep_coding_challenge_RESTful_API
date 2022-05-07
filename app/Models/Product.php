<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function attached_user(){
        return $this->hasMany('App\Models\UserProduct');
    }
}
