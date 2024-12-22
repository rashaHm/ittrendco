<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();    
        $user = auth()->user();
        if($user->hasRole('admin')){
            $users = User::all()->count();
            $categories = Category::all()->count();
            $products = Product::all()->count();
            return view('pages.users.admin_home',compact('users','categories','products','user'));
            
        } else if($user->hasRole('cooker')){
            $pending_orders = Order::where('state','pending')->count();  
            $in_progress_orders = Order::where('state','in_progress')->count(); 
            $done_orders = Order::where('state','done')->count(); 
            $all_orders = Order::all()->count(); 
            return view('pages.orders.index', compact( 'all_orders', 'user', 'pending_orders','in_progress_orders', 'done_orders') );
        }else{
            return view('pages.dashboard', compact('products', 'user') );
        }
    }
}
