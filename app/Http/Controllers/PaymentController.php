<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\MakePayment;
use App\Events\CustomerOrder;

class PaymentController extends Controller
{
    function place_order(Request $request){
        try{
            $user = auth()->user();
            $cart = Cart::where('user_id',$user->id)->where('active',1)->orderBy('created_at', 'desc')->first();
            $cart_products = $cart->products()->withPivot('quantity')->get();
            $total = 0.0;
            $tax = 0.0;
            foreach ($cart_products as $cart_product) {
                $total += ($cart_product->price * $cart_product->pivot->quantity );
            }
            $tax = ($total * 2) / 100;
            $order = Order::create([
                'payment_method'=> $request->method, 
                'user_id' => $user->id,
                'cart_id' => $cart->id,
                'state' => 'pending',
                'order_total' => $total,
                'tax' => $tax,
                'is_ordered' => 1
            ]);

            $payment = Payment::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'method' => $request->method,
                'notes' => $request->notes,
                'cart_id' => $cart->id
            ]); 

            $cart->active=0;
            $cart->save();       
          //  Mail::to('hmrasha2@gmail.com')->send(new MakePayment($user));
            event(new CustomerOrder('xxx'));
            return view('pages.store.invoice', compact('payment', 'total','user'));

        }catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }     
    }
}
