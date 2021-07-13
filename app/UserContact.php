<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    protected $fillable = ['user_id','number','contact_type'];
    public function User(){
    	return $this->belongsTo(User::class);
    }
}
