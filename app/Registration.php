<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [''];
    //
	public function User(){
        return $this->belongsTo('\App\User');
	}
	public function Examination(){
		return $this->belongsTo('\App\Examination','test_id');
	}
	public function Photo(){
        return  $this->belongsTo('\App\Photo');
    }

}
