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
        )->get()
        ->map(function ($products) {
            $products->image = str_replace('public', '', $products->image);
    
            return $products;
        });
        return ProductResource::collection($products);
    }
    public function findID($id)
    {
        header('Access-Control-Allow-Origin: *');

        $product = Product::find($id);
        $product->image = str_replace('public', '', $product->image);
        return new ProductResource($product); 
    }
}
