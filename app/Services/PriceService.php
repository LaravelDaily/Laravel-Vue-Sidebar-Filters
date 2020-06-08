<?php

namespace App\Services;

use App\Product;

class PriceService
{
    public function getPrices()
    {
        $prices = [];

        foreach(Product::PRICES as $index => $name) {
            $prices[] = [
                'name' => $name,
                'products_count' => $this->getProductCount($index)
            ];
        }

        return $prices;
    }

    private function getProductCount($index)
    {
        return Product::withFilters()
            ->when($index == 0, function ($query) {
                $query->where('price', '<', '5000');
            })
            ->when($index == 1, function ($query) {
                $query->whereBetween('price', ['5000', '10000']);
            })
            ->when($index == 2, function ($query) {
                $query->whereBetween('price', ['10000', '50000']);
            })
            ->when($index == 3, function ($query) {
                $query->where('price', '>', '50000');
            })
            ->count();
    }
}
