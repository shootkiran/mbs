<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function regid(){
        $exam = $this->Examination;
        $id = $this->collection_id;
        $regid = $exam->collection_prefix.sprintf("%05d",$id);
        return $regid;
    }
    public function registration(){
        return $this->hasMany(Registration::class);
    }
    public function Examination (){
        return $this->belongsTo(Examination::class);
    }

}
