<?php

namespace App\Models;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'created_at',
        'updated_at',
        'photo',
        
    ];

    public function scopeSelectOffers($query)
    {
        return $query->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','price','photo');
    }
    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en']=strtoupper($value);
    }
}
