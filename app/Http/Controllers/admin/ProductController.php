<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{

    public function index(Request $request) {

        $products = Product::with('category')->oldest();

        if(!empty($request->get('keyword'))) {
            $products = $products->where('name', 'like', '%'.$request->get('keyword').'%');
        }

        $products = $products->paginate(10);

        return view('admin.product.list',compact('products'));

    }

    public function create() {

        $data = [];
        $categories = Category::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
        $data['categories'] = $categories; 
        $data['brands'] = $brands; 

        return view('admin.product.create', $data);
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'brand' => 'required',
        ]);

        if($validator->passes()) {

            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;
            $product->status = $request->status;
            $product->save();

            $request->session()->flash('success', 'Product updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($productId, Request $request) {

        $product = Product::find($productId);

        if(empty($product)) {
            return redirect()->route('products.index');
        }

        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update($productId, Request $request) {

        $product = Product::find($productId);

        if(empty($product)) {
            $request->session()->flash('success', 'Product not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Product not found'
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'brand' => 'required',
        ]);

        if($validator->passes()) {

            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;
            $product->status = $request->status;
            $product->save();

            $request->session()->flash('success', 'Product updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function destroy($productId, Request $request) {

        $product = Product::find($productId);

        if(empty($product)) {

            $request->session()->flash('error', 'Product not found');
            return response()->json([
                'status' => true,
                'message' => 'Product not found'
            ]);
        }

        $category->delete();

        $request->session()->flash('success', 'Product deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);

    }
}
