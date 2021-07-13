<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function UserRegistration(){
        return $this->belongsTo(UserRegistration::class);
    }
}
