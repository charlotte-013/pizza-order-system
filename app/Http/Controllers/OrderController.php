<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order list page
    public  function orderList() {
        $order = Order::select('orders.*', 'users.name as user_name')
                ->when(request('key'), function ($query) {
                    $query->where('users.name', 'like', '%'.request('key').'%')
                        ->orWhere('orders.order_code', 'like', '%'.request('key').'%');
                })
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        $order->appends(request()->all());
        return view('admin.order.list', compact('order'));
    }

    // order list
    public function listInfo($orderCode) {
        $order = Order::where('order_code', $orderCode)->first();

        $orderList = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
                    ->leftJoin('users', 'users.id', 'order_lists.user_id')
                    ->leftJoin('products', 'products.id', 'order_lists.product_id')
                    ->where('order_code', $orderCode)
                    ->get();

        return view('admin.order.productList', compact('orderList', 'order'));
    }


    // order status change
    public function changeStatus(Request $request) {
        $order = Order::select('orders.*', 'users.name as user_name')
                ->when(request('key'), function ($query) {
                    $query->where('users.name', 'like', '%' . request('key') . '%')
                        ->orWhere('orders.order_code', 'like', '%' . request('key') . '%');
                })
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at', 'desc');

        if($request->orderStatus == null) {
            $order = $order->paginate(10);
        } else {
            $order = $order->where('orders.status', $request->orderStatus)->paginate(10);
        }
        $order->appends(request()->all());

        return view('admin.order.list', compact( 'order'));
    }

    // ajax change status
    public function ajaxChangeStatus(Request $request) {
        Order::where('id', $request->orderId)->update([
            'status' => $request->status
        ]);
    }
}
