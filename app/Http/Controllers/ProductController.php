<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Arr;


class ProductController extends Controller
{
    const ITEM_PER_PAGE = 15;

    public function index(Request $request)
    {
        $products = Product::all();    
        $user= auth()->user();
        return view('pages.products.index', compact('products','user')); 
    }

    public function create()
    {
        $categories = Category::all();    
        $user= auth()->user();
        return view('pages.products.add_product', compact('categories','user'));
    }

    public function store(Request $request)
    {
        try{
            $originalName = $request->image->getClientOriginalName();
            $params = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->image;
                $path = $image->storeAs('uploads', $originalName, 'public');
                $url = Storage::url($path);
            }

            $params = $request->all();
            $Product = Product::create([
                'name' => $params['name'],
                'category_id' => $params['category_id'],
                'stock' => $params['stock'],
                'price' => $params['price'],
                'description' => $params['description'],
                'image' =>  $originalName,
            ]);
            $products = Product::all();   
            return redirect('products')->with('products'); 
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    public function show($id)
    {
        $Product = Product::where('id', $id)->first();
        return response()->json(["data"=>$Product]);
    }

    public function edit(Producteur $producteur)
    {
        //
    }

    public function update(Request $request)
    {
        try{
            $Product = Product::where('id', $request->id)->first();
            if( $request->name) $Product->name = $request->name;
            if( $request->category_id) $Product->category_id = $request->category_id;
            if( $request->stock) $Product->stock = $request->stock;
            if( $request->price) $Product->price = $request->price;
            if( $request->description) $Product->description = $request->description;
 
            if( $request->image){
                File::delete('images/'.$Product->image);
                $Product->image = $request->image;
            }
            $Product->save();
            return response()->json(["data"=>$Product]);
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    public function destroy($id)
    {
        try {
            $Product = Product::where('id', $id)->first();
            if (File::exists('images/'.$Product->image)) {
                File::delete('images/'.$Product->image);
            }            
            $Product->delete();
        } catch (\Exception $ex) {
            return redirect('home');
        }
        return response()->json(null, 204);
    }
}
