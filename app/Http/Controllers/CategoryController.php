<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Arr;

class CategoryController extends Controller
{
    const ITEM_PER_PAGE = 15;

    public function index(Request $request)
    {
        $categories = Category::all();    
        $user= auth()->user();
        return view('pages.categories.index', compact('categories','user')); 
    }

    public function create()
    {
        $user= auth()->user();
        return view('pages.categories.add_category',compact('user')); 
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
            $category = category::create([
                'name' => $params['name'],
                'image' => $originalName ,
            ]);           
            $categories = Category::all();    
            return redirect('categories')->with('categories'); 
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    public function show($id)
    {
        $category = category::where('id', $id)->first();
        return response()->json(["data"=>$category]);
    }

    public function edit(Producteur $producteur)
    {
        //
    }

    public function update(Request $request)
    {
        try{
            $category = category::where('id', $request->id)->first();
            $category->name = $request->name;

            if( $request->image){
                File::delete('images/'.$category->image);
                $category->image = $request->image;
            }
            $category->save();
            return response()->json(["data"=>$category]);
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

    public function destroy($id)
    {
        try {
            $category = category::where('id', $id)->first();
            if (File::exists('images/'.$category->image)) {
                File::delete('images/'.$category->image);
            }            
            $category->delete();
        } catch (\Exception $ex) {
            return redirect('home');
        }
        return response()->json(null, 204);
    }
}
