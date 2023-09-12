<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
class Hospital extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'name',
        'address',
        'country_id',
        'created_at',
        'updated_at', 
    ];
    protected $hidden = 
    [
        'created_at',
        'updated_at', 
    ];
      
    public $timestamps=true;
    public function doctors()
    {
        return $this->hasMany(Doctor::class,'hospital_id','id');
    }
    public function countries()
    {
        return $this->belongsTo(Country::class);
    }
}