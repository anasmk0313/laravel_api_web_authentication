<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Register(Request $request){
        
        $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:admin_users,username',
            'password'  => 'required',
        ]);

        $user = new AdminUser();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', 'New user has been created');
        return redirect(url('/user/login'));

    }

    public function Login(Request $request){
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $user = AdminUser::where('username', $request->username)
        ->first();

        if(!$user){

            session()->flash('error', 'Credential Mismatch');
            return redirect(url('/user/login'));
        }

        if(!Hash::check($request->password, $user->password)){

            session()->flash('error', 'Credential Mismatch');
            return redirect(url('/user/login'));
        }
        
        $credential = $request->only('username', 'password');

        Auth::guard('web')->attempt($credential);

        return redirect(url('dashboard'));

    }
}
