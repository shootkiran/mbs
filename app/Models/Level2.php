<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level2 extends Model
{
    public $timestamps = false;
    protected $table = "level2";
    protected $fillable=['sn','reg_id','examination_id'];

}
