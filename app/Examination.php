<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    public function Venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function Collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function Registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function UserRegistrations()
    {
        return $this->hasMany(UserRegistration::class);
    }

    public function Venues()
    {
        return $this->hasMany(Venue::class);
    }
    public function Level1(){
        return $this->hasMany(Level1::class);
    }
    public function Level2(){
        return $this->hasMany(Level2::class);
    }
    public function Level3(){
        return $this->hasMany(Level3::class);
    }
    public function Level4(){
        return $this->hasMany(Level4::class);
    }
    public function Level5(){
        return $this->hasMany(Level5::class);
    }
}
