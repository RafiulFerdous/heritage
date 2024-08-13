<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'location',
        'min_value',
        'max_value',
        'image',
        'status',
    ];

    public function details()
    {
        return $this->hasOne(PropertyDetail::class);
    }


    public function scopePriceRange($query, $minValue, $maxValue)
    {
        return $query->whereBetween('min_value', [$minValue, $maxValue]);
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
