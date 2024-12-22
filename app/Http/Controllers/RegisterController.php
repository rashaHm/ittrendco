<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255'
        ]);
        $user = User::create($attributes);
        $role=Role::where(['name'=>'customer'])->first();
        $user->assignRole($role);      
        $user->save();
       // auth()->login($user);
        return redirect('/login');
    }
}
