<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Events\CustomerOrder;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $user = auth()->user(); 
        return view('pages.orders.all_orders', compact('orders','user')); 
    }

    function placeOrder(Request $request) {
        try{
            $user= auth()->user();
            $cart = Cart::where('user_id',$user->id)->where('active',1)->orderBy('created_at', 'desc')->first();
            $order_total = 0.0;
            $tax = 0.0;
            foreach($cart->cart_items as $item){
                $product = Product::where('id', $item->product_id)->first();
                $order_total += $product->price * $item->quantity;
            }
            $tax = ($order_total * 2) / 100;
            if($cart){
                $order = Order::create([
                    'payment_method'=> $request->payment_method, 
                    'user_id' => $user->id,
                    'cart_id' => $cart->id,
                    'state' => 'complate',
                    'order_total' => $order_total,
                    'tax' => $tax,
                    'is_ordered' => 1
                ]);
                $cart->active=0;
                $cart->save();
            }
            return response()->json(['message' => 'Order placed sucessfully!'], 200);            
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    function update_order(Request $request,$order_id) {
        try{
            $order = Order::where('id',$order_id)->first();
            $order->state = $request->order_state;
            $order->save();
            return redirect('orders');

        }catch (\Exception $ex) {
            return redirect('home');
        }
        
    }
}
