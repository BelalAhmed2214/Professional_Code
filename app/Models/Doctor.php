<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;
use App\Models\Service;
class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'gender',
        'hospital_id', 
        'medical_id',
        'created_at',
        'updated_at',
    ];
      protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',

    ];
    public $timestamps=true;
    
    public function hospital()
    {
        return $this->belongsTo(Hospital::class,'hospital_id','id');
    }


    public function services()
    {
        return $this->belongsToMany(Service::class,'doctor_service','doctor_id','service_id');
    }

    public function getGenderAttribute()
    {
        if($this->gender ==1)
            return "Male";
        else
            return "female";
    }
}
?>
