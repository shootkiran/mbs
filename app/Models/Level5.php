<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level5 extends Model
{
    public $timestamps = false;
    protected $table = "level5";
    protected $fillable=['sn','reg_id','examination_id'];

}
