<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request) {

        $brands = Brand::latest('brands.id');

        if(!empty($request->get('keyword'))) {
            $brands = $brands->where('name', 'like', '%'.$request->get('keyword').'%');
        }

        $brands = $brands->paginate(10);

        return view('admin.brand.list',compact('brands'));

    }

    public function create() {

        return view('admin.brand.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->passes()) {

            $brand = new Brand();
            $brand->name = $request->name;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash('success', 'Brand added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($brandId, Request $request) {

        $brand = Brand::find($brandId);

        if(empty($brand)) {
            return redirect()->route('brands.index');
        }

        return view('admin.brand.edit', compact('brand'));
    }

    public function update($brandId, Request $request) {

        $brand = Brand::find($brandId);

        if(empty($brand)) {
            $request->session()->flash('success', 'Brand not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Brand not found'
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->passes()) {

            $brand->name = $request->name;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash('success', 'Brand updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Brand updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function destroy($brandId, Request $request) {

        $brand = Brand::find($brandId);

        if(empty($brand)) {

            $request->session()->flash('error', 'Brand not found');
            return response()->json([
                'status' => true,
                'message' => 'Brand not found'
            ]);
        }

        $brand->delete();

        $request->session()->flash('success', 'Brand deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully'
        ]);

    }
}
