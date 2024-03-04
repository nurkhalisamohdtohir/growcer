<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $data['cartContent'] = $cartContent;
        
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

    public function checkout() {

        //if cart is empty redirect to cart page
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        //if user is not logged in then redirect to login page
        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login');
        }

        $customerAddress = CustomerAddress::where('user_id',Auth::user()->id)->first();

        session()->forget('url.intended');

        //Calculate total including shipping charge
        $shipping = 5;
        $grandTotal = Cart::subtotal()+$shipping;

        return view('front.checkout', [
            'customerAddress' => $customerAddress,
            'shipping' => $shipping,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function processCheckout(Request $request) {

        $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',
        ]);

        if($validator->fails()) {

            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'building' => $request->building,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );

        if ($request->payment_method == 'cod') {

            $shipping = 5;
            $discount = 0;
            $subTotal = Cart::subtotal(2,'.','');
            $grandTotal = $subTotal+$shipping;

            $order = new Order;
            $order->subtotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'not paid';
            $order->status = 'pending';
            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->address = $request->address;
            $order->building = $request->building;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->save();

            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->quantity = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price*$item->qty;
                $orderItem->save();
            }

            session()->flash('success','You have successfully placed your order.');

            Cart::destroy();

            return response()->json([
                'message' => 'Order saved successfully',
                'orderId' => $order->id,
                'status' => true
            ]);

        } else {

        }

    }

    public function thankyou($id) {

        return view('front.thanks',[
            'id' => $id
        ]);
    }
}
