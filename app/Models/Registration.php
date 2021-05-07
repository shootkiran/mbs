<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = ['name', 'dobad', 'level', 'reg_number', 'collection_id', 'payment_id', 'payment_received', 'examination_id', 'user_id'];

    //
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function Examination()
    {
        return $this->belongsTo(Examination::class);
    }

}
