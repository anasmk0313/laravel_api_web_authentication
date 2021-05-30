<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if($validate->fails()){

            return response()->json([
                'status' => 'error',
                'messages' => 'Invalid request',
                'errors' => $validate->errors()
            ],400);
        }

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'messages' => 'New user has been created',
        ],200);
    }

    public function login(Request $request){

        $rules = [
            'email'     => 'required|email',
            'password'  => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if($validate->fails()){

            return response()->json([
                'status' => 'error',
                'messages' => 'Invalid request',
                'errors' => $validate->errors()
            ],400);
        }

        $user = User::where('email', $request->email)
        ->first();

        if(!$user){

            return response()->json([
                'status' => 'error',
                'messages' => 'Credential Mismatch',
            ],400);
        }

        if(!Hash::check($request->password, $user->password)){

            return response()->json([
                'status' => 'error',
                'messages' => 'Credential Mismatch',
            ],400);
        }

        $credential = $request->only('username', 'password');

        Auth::login($user);
        
        $token = Auth::user()->createToken('TutsForWeb')->accessToken;

        return response()->json([
            'status'        => 'success',
            'messages'      => 'User login successfull',
            'token'         => $token,
        ],200);
    }

    public function viewProduct(){

        $product = Product::orderBy('product_name')
        ->get();

        return response()->json([
            'status'    => 'success',
            'data'      => $product,
        ],200);
    }
}
