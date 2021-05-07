<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dobad', 'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserRegistration()
    {
        return $this->hasMany(UserRegistration::class);
    }

    public function Contact()
    {
        return $this->hasMany(UserContact::class);
    }

    public function Photo()
    {
        return $this->hasOne(Photo::class);
    }

    public function Payments()
    {
        $uregs = $this->UserRegistration()->pluck('id');
        $payments = Payment::whereIn('user_registration_id', $uregs);
        return $payments;
    }

    public function Examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
