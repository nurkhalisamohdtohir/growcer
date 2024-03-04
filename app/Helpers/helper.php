<?php

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

function getCategories(){
    return Category::orderBy('id','ASC')->get();
}

function getBrands(){
    return Brand::orderBy('id','ASC')->get();
}

function getRecipes(){
    return Product::whereNotNull('recipe')->where('recipe', '!=', '')->distinct()->pluck('recipe');
}

function getProductImage($productId){
    return Product::where('id',$productId)->first();
}

?>