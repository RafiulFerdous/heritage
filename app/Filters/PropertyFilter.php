<?php

namespace App\Filters;

class PropertyFilter extends QueryFilter
{
    public function min_value($value)
    {
        return $this->builder->where('min_value', '>=', $value);
    }

    public function max_value($value)
    {
        return $this->builder->where('max_value', '<=', $value);
    }

    public function number_of_bed($value)
    {
        return $this->builder->whereHas('details', function ($query) use ($value) {
            $query->where('number_of_bed', $value);
        });
    }

    public function num_of_bath($value)
    {
        return $this->builder->whereHas('details', function ($query) use ($value) {
            $query->where('num_of_bath', $value);
        });
    }

    public function is_fully_furnished($value)
    {
        return $this->builder->whereHas('details', function ($query) use ($value) {
            $query->where('is_fully_furnished', $value);
        });
    }
}
