<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $fillable = ['user_registration_id', 'photo_id', 'verified'];
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function userRegistration()
    {
        return $this->belongsTo(UserRegistration::class);
    }
}
