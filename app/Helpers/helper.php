<?php

use App\Models\Category;
use App\Models\Brand;

function getCategories(){
    return Category::orderBy('id','ASC')->get();
}

function getBrands(){
    return Brand::orderBy('id','ASC')->get();
}

?>