<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'number_of_bed',
        'num_of_bath',
        'num_of_balcony',
        'is_fully_furnished',
        'carpet_area',
        'floor',
        'transection_type',
        'facing',
        'additional_rooms',
        'age_of_construction',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    public function scopeNumberOfBed($query, $number)
    {
        return $query->where('number_of_bed', $number);
    }


    public function scopeNumberOfBath($query, $number)
    {
        return $query->where('num_of_bath', $number);
    }


    public function scopeIsFullyFurnished($query, $furnished)
    {
        return $query->where('is_fully_furnished', $furnished);
    }
}
