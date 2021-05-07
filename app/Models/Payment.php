<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['voucher_number','verified','user_registration_id','bank_branch','deposit_date','deposit_by','photo_id'];
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
    public function userRegistration(){
        return $this->belongsTo(UserRegistration::class);
    }
}
