<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    protected $fillable =
    [
        'name',
    ];
    
    public $timestamps=false;
    
    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class,Hospital::class);
    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
    
}
