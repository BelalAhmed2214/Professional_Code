<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Phone extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
      'code',
      'phone',
      'user_id', 
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'user_id', 

    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
