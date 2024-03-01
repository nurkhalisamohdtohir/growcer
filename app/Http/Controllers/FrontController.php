<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontController extends Controller
{
    public function index() {

        $recipes = Product::whereNotNull('recipe')->where('recipe', '!=', '')->distinct()->pluck('recipe');
        $data['recipes'] = $recipes;

        return view('front.home',$data);

    }
}
