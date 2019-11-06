<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = "tests";
    public function Venue(){
        return $this->belongsTo('\App\Venue');
    }
}
