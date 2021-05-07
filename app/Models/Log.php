<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
   protected $fillable = ['activity','collection_id','registration_id','user_id','photo_id'];
}
