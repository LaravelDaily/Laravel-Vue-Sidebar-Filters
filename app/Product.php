<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'manufacturer_id'];

    const PRICES = [
        'Less than 50',
        'From 50 to 100',
        'From 100 to 500',
        'More than 500',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithFilters($query, $prices, $categories, $manufacturers)
    {
        return $query->when(count($manufacturers), function ($query) use ($manufacturers) {
                $query->whereIn('manufacturer_id', $manufacturers);
            })
            ->when(count($categories), function ($query) use ($categories) {
                $query->whereIn('category_id', $categories);
            })
            ->when(count($prices), function ($query) use ($prices){
                $query->where(function ($query) use ($prices) {
                    $query->when(in_array(0, $prices), function ($query) {
                            $query->orWhere('price', '<', '5000');
                        })
                        ->when(in_array(1, $prices), function ($query) {
                            $query->orWhereBetween('price', ['5000', '10000']);
                        })
                        ->when(in_array(2, $prices), function ($query) {
                            $query->orWhereBetween('price', ['10000', '50000']);
                        })
                        ->when(in_array(3, $prices), function ($query) {
                            $query->orWhere('price', '>', '50000');
                        });
                });
            });
    }
}
