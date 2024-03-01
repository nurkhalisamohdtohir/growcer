<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request) {

        $product = Product::find($request->id);
        
        if ($product == null) {

            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        if (Cart::count() > 0) {

            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->name, 1, $product->price, ['productImage' => $product->image]);

                $status = true;
                $message = $product->name.' added in your cart successfully.';
                session()->flash('success',$message);

            } else {
                $status = false;
                $message = $product->name.' already added in cart.';
            }

        } else {
            Cart::add($product->id, $product->name, 1, $product->price, ['productImage' => $product->image]);
            $status = true;
            $message = $product->name.' added in your cart successfully.';
            session()->flash('success',$message);
        }

       return response()->json([
            'status' => $status,
            'message' => $message
       ]);

    }

    public function cart() {
        $cartContent = Cart::content();
        $recipes = Product::whereNotNull('recipe')->where('recipe', '!=', '')->distinct()->pluck('recipe');
        //dd($cartContent);
        $data['cartContent'] = $cartContent;
        $data['recipes'] = $recipes;
        
        return view('front.cart',$data);
    }

    public function updateCart(Request $request) {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);

        //check qty available in stock
        if ($qty <= $product->quantity) {

            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully.';
            $status = true;
            session()->flash('success',$message);
        } else {

            $message = 'Request qty('.$qty.') not available in stock.';
            $status = false;
            session()->flash('error',$message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);

    }

    public function deleteItem(Request $request) {

        $itemInfo = Cart::get($request->rowId);

        if($itemInfo == null) {

            $errorMessage = 'Item not found in cart.';
            session()->flash('error',$errorMessage);

            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);

        $message = 'Item removed from cart successfully.';
        session()->flash('error',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}
