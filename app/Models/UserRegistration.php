<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function Photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function Payment()
    {
        return $this->belongsTo(Payment::class);
    }


    public function Citizenship()
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function Passport()
    {
        return $this->belongsTo(Passport::class);
    }

    public function Status()
    {
        $text = "";
        if (!$this->Photo) {
            $text .= "<i class='text-danger'>Photo is Missing,</i>";
        }
        if (!$this->Payment) {
            $text .= " <i class='text-danger'>Payment Voucher is Missing</i>";
        }
        if($this->Payment and $this->Photo){
            if (!$this->Payment->verified) {
                $text .= "<i class='text-danger'>Payment Verification on Process. Please call NAT-TEST Committee on TEL:014482809 MOB:9851126834 if the verification process took longer than expected.</i>";
            }
            if ($this->Payment->verified==1) {
                $text .= "<i class='text-success'>Process Completed</i>";
            }
            if($this->Payment->verified==2){
                $text .= "<i class='text-warning bg-danger'>Manual Verification Required. Contact NAT-TEST Committee on TEL:014582809 OR MOB:9851126834</i>";
            }
        }

        return $text;
    }

}
