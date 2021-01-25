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
        header('Access-Control-Allow-Origin: *');
        $products = Product::withFilters(
            request()->input('prices', []),
            request()->input('categories', []),
            request()->input('manufacturers', [])
        )->get();

        return ProductResource::collection($products);
    }
    public function findID($id)
    {
        $product = Product::find($id);
        return new ProductResource($product); 
    }
}
