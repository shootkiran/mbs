<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level3 extends Model
{
    public $timestamps = false;
    protected $table = "level3";
    protected $fillable=['sn','reg_id','examination_id'];

}
