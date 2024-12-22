<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    function cart(Request $request){
        try{
            $user= auth()->user();
            $cart = Cart::where('user_id',$user->id)->where('active',1)->orderBy('created_at', 'desc')->first();
            if($cart){
                $cart_products = $cart->products()->withPivot('quantity')->get();
                return view('pages.store.cart', compact('cart_products','user'));
            }else{
                $cart_products = [];
                return view('pages.store.cart', compact('cart_products','user'));
            }
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    function add_to_cart(Request $request, $product_id) {
        try{
            $user= auth()->user();
            $cart = Cart::where('user_id',$user->id)->where('active',1)->orderBy('created_at', 'desc')->first();
            if(!$cart){
                $cart = Cart::create([ 
                    'user_id' => $user->id,
                    'active'=>1]); 
            }
            $product = Product::where('id',$product_id)->first();
            $cart_products = $cart->products()->where('product_id', $product->id )->first();
            if($cart_products != []){
                $product_quantity = $cart_products->pivot->quantity;
                $cart->products()->detach($product->id);
                $cart->products()->attach($product->id,[
                    'quantity'=>$product_quantity+1,
                    'updated_at' => now()]);
            }else{
                DB::table('cart_products')->insert([
                    'cart_id'=> $cart->id,
                    'product_id'=>$product_id,
                    'quantity'=> 1,
                    'created_at' => now(), // Optional: Include timestamps if needed
                    'updated_at' => now(), 
                ]);
            }
            $cart_products = $cart->products()->withPivot('quantity')->get();
            return redirect('cart')->with('cart_products');//, compact('cart_products'));
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    function remove_from_cart(Request $request, $product_id){
        try{
            $user= auth()->user();
            $cart = Cart::where('user_id',$user->id)->where('active',1)->orderBy('created_at', 'desc')->first();
            $product = Product::where('id',$product_id)->first();
            $cart->products()->detach($product->id);
            $cart_products = $cart->products()->withPivot('quantity')->get();
            return redirect('cart')->with('cart_products');
        }catch (\Exception $ex) {
                return redirect('home');
            }
    }

    function purchase(Request $request){
        $user= auth()->user();
        return view('pages.store.purchase',compact('user'));
    }
}
