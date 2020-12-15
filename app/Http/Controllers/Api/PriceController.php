<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PriceService;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(PriceService $priceService)
    {
        $prices = $priceService->getPrices(
            request()->input('prices', []),
            request()->input('categories', []),
            request()->input('manufacturers', [])
        );

        return response()->json($prices);
    }
}
