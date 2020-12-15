<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withFilters(
            request()->input('prices', []),
            request()->input('categories', []),
            request()->input('manufacturers', [])
        )->get();

        return ProductResource::collection($products);
    }
}
