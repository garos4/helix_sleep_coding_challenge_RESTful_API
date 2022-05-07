<?php

namespace App\Traits;

use App\Models\User;

trait AttachedUser
{
    public static function bootAttachedUser()
    {
        static::creating(function ($model) {
            $model->user_id = auth('api')->check() ? auth('api')->user()->id : null;
        });
    }

    public function attachedUser()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault([
            'name' => 'No name'
        ]);
    }
}
