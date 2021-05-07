<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level1 extends Model
{
    public $timestamps = false;
    protected $table = "level1";
    protected $fillable=['sn','reg_id','examination_id'];

}
