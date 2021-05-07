<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level4 extends Model
{
    public $timestamps = false;
    protected $table = "level4";
    protected $fillable=['sn','reg_id','examination_id'];

}
