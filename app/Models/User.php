<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Phone;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'expire',
        'age',
       
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];


    ####### Beign Relations ###############

    public function phone()
    {
        return $this -> hasOne(Phone::class,'user_id');
    }
    ####### End Relations #################
    
}
