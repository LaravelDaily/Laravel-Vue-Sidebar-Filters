<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManufacturerResource;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::withCount(['products' => function ($query) {
                $query->withFilters(
                    request()->input('prices', []),
                    request()->input('categories', []),
                    request()->input('manufacturers', [])
                );
            }])
            ->get();

        return ManufacturerResource::collection($manufacturers);
    }
}
