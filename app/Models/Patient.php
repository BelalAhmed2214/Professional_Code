<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'age',
    ];
    
    public $timestamps=false;
    

    public function doctors()
    {
        //the Second argument is the through table which link between the other two tables
        return $this->hasOneThrough(Doctor::class,Medical::class);
    }
}
