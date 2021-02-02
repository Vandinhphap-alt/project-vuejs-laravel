<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        $categories = Category::withCount(['products' => function ($query) {
            
                $query->withFilters(
                    request()->input('prices', []),
                    request()->input('categories', []),
                    request()->input('manufacturers', [])
                );
            }])
            ->get();

        return CategoryResource::collection($categories);
    }
    public function findID($id)
    {
        header('Access-Control-Allow-Origin: *');
        $category = Category::with('products')->find($id);
        foreach($category->products as $ct){
            $ct->image = str_replace('public','',$ct->image);
        }
        return new CategoryResource($category,$ct); 
    }
}
