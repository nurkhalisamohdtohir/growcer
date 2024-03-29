<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request){

        $categories = Category::orderBy('id','ASC')->where('status', 1)->get();
        $brands = Brand::orderBy('id','ASC')->where('status', 1)->get();
        
        $brandsArray = [];
        $categoriesArray = [];

        $products = Product::where('status', 1);

        //Apply Filters
        if(!empty($request->get('category'))) {
            $categoriesArray = explode(',', $request->get('category'));
            $categories = $products->whereIn('category_id', $categoriesArray);
        }

        if(!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('brand_id', $brandsArray);
        }

        if(!empty($request->get('search'))) {
            $products = $products->where('name','like','%'.$request->get('search').'%');
        }

        $products = $products->orderBy('id','ASC');
        $products = $products->paginate(12);

        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categoriesArray'] = $categoriesArray;
        $data['brandsArray'] = $brandsArray;

        return view('front.shop', $data);
    }

    public function recipe($recipe) {
        
        $products = Product::where('recipe', $recipe)->get();
        
        $data['products'] = $products;
        
        if ($recipe == 'Bubur Ayam') {
            return view('front.recipe', $data, compact('recipe'));
        } elseif ($recipe == 'Milo Smoothies') {
            return view('front.recipe2', $data, compact('recipe'));
        } else {
            return view('front.shop', $data);
        }
    }
}
