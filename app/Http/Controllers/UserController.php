<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $all_users = User::all();    
        $user= auth()->user();
        return view('pages.users.index', compact('user','all_users')); 
    }

    public function create()
    {
        $user= auth()->user();
        return view('pages.users.add_user',compact('user')); 
    }

    public function store(Request $request)
    {
        
        try{
            $params = $request->all();
            if($params['password'] != $params['confirm_password']){
                $error = true;
                $message = "password don't match";
                return redirect('add-user')->with(['message','error']); 
            }
                    
            $user = User::create([
                'username' => $params['name'],
                'password' => $params['password'] ,
                'email' => $params['email'],
            ]); 
            $role=Role::where(['name'=>$params['role']])->first();
            if(! $role){
                $role = Role::create(['name'=>$params['role']]);
            }
            $user->assignRole($role);          
            $user->save();
           // $users = User::all();
           // $user= auth()->user();            
            return redirect('users'); 
        }catch (\Exception $ex) {
            return redirect('home');
        }
    }

}
