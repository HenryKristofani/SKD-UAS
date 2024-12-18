<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'otp_expires_at',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
    ];

    // Method to generate OTP
    public function generateOTP()
    {
        $this->otp = str_pad(random_int(1, 999999), 6, '0', STR_PAD_LEFT);
        $this->otp_expires_at = now()->addMinutes(10);
        $this->save();

        return $this->otp;
    }

    // Method to verify OTP
    public function verifyOTP($otp)
    {
        return $this->otp === $otp && 
               $this->otp_expires_at && 
               $this->otp_expires_at->isFuture();
    }

    // Method to clear OTP after verification
    public function clearOTP()
    {
        $this->otp = null;
        $this->otp_expires_at = null;
        $this->email_verified_at = now();
        $this->save();
    }

    // Additional method example (new feature)
    public function isAccountVerified()
    {
        return !is_null($this->email_verified_at);
    }

    // Additional method example: deactivate account
    public function deactivateAccount()
    {
        $this->update(['is_active' => false]);
    }
}
