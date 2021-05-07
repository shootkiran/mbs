<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    //
    public function status(){
        $validity = Carbon::parse($this->valid_untill);
        $today = Carbon::today();
        if( $today->diffInDays($validity,false) <0){
            return "<i class='text-danger'>Expired</i>";
        }else{
            return "<i class='text-success'>Active</i>";
        };
    }
}
