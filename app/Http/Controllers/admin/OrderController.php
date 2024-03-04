<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index(Request $request) {

        $orders = Order::latest('orders.id');
        $orders = $orders->leftJoin('users','users.id','orders.user_id')->select('orders.*', 'users.name as name');

        if ($request->get('keyword') != "") {
            $orders = $orders->where('users.name','like','%'.$request->keyword.'%');
            $orders = $orders->orWhere('users.email','like','%'.$request->keyword.'%');
            $orders = $orders->orWhere('orders.id','like','%'.$request->keyword.'%');
        }

        $orders = $orders->paginate(10);

        return view('admin.order.list',[
            'orders' => $orders
        ]);
    }

    public function detail($orderId) {

        $order = Order::where('id',$orderId)->first();
        $orderItems = OrderItem::where('order_id',$orderId)->get();
        
        return view('admin.order.detail',[
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }

    public function changeOrderStatus(Request $request, $orderId) {

        $order = Order::find($orderId);
        $order->status = $request->status;
        $order->save();

        session()->flash('success','Order status changed successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Order status changed successfully.'
        ]);

    }
}
