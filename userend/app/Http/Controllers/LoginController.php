<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => env('PUBLIC_URL').'/api/user/register',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $request->name, 'email' => $request->email,'password' => 'anasmk'),
        // CURLOPT_HTTPHEADER => array(
        //     'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTE4MGY3MjlkOWUyNTViY2M4NTBhNWViZjQzMzMyOTgwYjE2OTg3ZWYxNzIzMTA2OGNjNWE0M2M0MjI4MzU5NmE2YWIyMzI3ZDBkNWIxYzMiLCJpYXQiOjE2MjIzNDY5MTgsIm5iZiI6MTYyMjM0NjkxOCwiZXhwIjoxNjUzODgyOTE4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Y1m-DQ_MCh0eC6Zs1MYkDh2G2FwrGPRu54eOtrm33FhG5h9Es7k7Mz-9LhxNG9ARu-H5Iak1wqUnU8vmYJB-cA9eLksoIdNfGcuh-6TQgxhN6oQvXBmqbKb1Pubz4tDFi3zkUQ02Cbg6mH4c0GjTXjbrwbx6T8hJHyAWOMsytr6XLOvgG1KtoeocHCMfn3lxAz7yhuR699jcPmNiz7dHwCkzfDDVJrvM6XO2eH6-7jO0MsAV6BGw9ngOnvxGaGlXGLAG4MSJQmGovTvkXjrrFw7aj8gqpVJjgsN5KJBlTb_wqPySNxaCXP78iJwwR25oUKecPf1MMaLWZJCwlMKtlfK-ySb9ZPu1o0U5eQ5TgHPhYmdt3HgnMLe-OpKF0Q3YY7rS7VzqYl5Cyt5Glmy3-FzKN4DL33cXdyXzTdR986PMigT6DTOKBe-5ruz3SOGgbON8VD0B4zBFno7zLKs383FNJa1qgJNJatp-ErmLC12wlAP8Yjr402wG82ygC7Gkik99RyalfKvzYW-LTMAZNB29HPbZ7XYS8GM6uCzqKxM_q00GUB-idBryt4jrPA_diAr_9q3s-1lDRbSKeQfMV3-suzGEE0GC8Or0rtuRyNVZtxsS7iwmdmkNbBBnFmhaw1GHl2aW3cnn_xRjFtfofVXQp93BrlBbhxp4BaIx6gw'
        // ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        
        if($response['status'] == 'error'){

            session()->flash('error', $response['messages']);
            return redirect()->back();
        }
        else{
            session()->flash('success', $response['messages']);
            return redirect()->route('login');
        }
    }

    public function login(Request $request){

        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => env('PUBLIC_URL').'/api/user/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('email' => 'anasmk@gmail.com','password' => 'anasmk'),
        // CURLOPT_HTTPHEADER => array(
        //     'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTE4MGY3MjlkOWUyNTViY2M4NTBhNWViZjQzMzMyOTgwYjE2OTg3ZWYxNzIzMTA2OGNjNWE0M2M0MjI4MzU5NmE2YWIyMzI3ZDBkNWIxYzMiLCJpYXQiOjE2MjIzNDY5MTgsIm5iZiI6MTYyMjM0NjkxOCwiZXhwIjoxNjUzODgyOTE4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Y1m-DQ_MCh0eC6Zs1MYkDh2G2FwrGPRu54eOtrm33FhG5h9Es7k7Mz-9LhxNG9ARu-H5Iak1wqUnU8vmYJB-cA9eLksoIdNfGcuh-6TQgxhN6oQvXBmqbKb1Pubz4tDFi3zkUQ02Cbg6mH4c0GjTXjbrwbx6T8hJHyAWOMsytr6XLOvgG1KtoeocHCMfn3lxAz7yhuR699jcPmNiz7dHwCkzfDDVJrvM6XO2eH6-7jO0MsAV6BGw9ngOnvxGaGlXGLAG4MSJQmGovTvkXjrrFw7aj8gqpVJjgsN5KJBlTb_wqPySNxaCXP78iJwwR25oUKecPf1MMaLWZJCwlMKtlfK-ySb9ZPu1o0U5eQ5TgHPhYmdt3HgnMLe-OpKF0Q3YY7rS7VzqYl5Cyt5Glmy3-FzKN4DL33cXdyXzTdR986PMigT6DTOKBe-5ruz3SOGgbON8VD0B4zBFno7zLKs383FNJa1qgJNJatp-ErmLC12wlAP8Yjr402wG82ygC7Gkik99RyalfKvzYW-LTMAZNB29HPbZ7XYS8GM6uCzqKxM_q00GUB-idBryt4jrPA_diAr_9q3s-1lDRbSKeQfMV3-suzGEE0GC8Or0rtuRyNVZtxsS7iwmdmkNbBBnFmhaw1GHl2aW3cnn_xRjFtfofVXQp93BrlBbhxp4BaIx6gw'
        // ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if($response['status'] == 'error'){
            session()->flash('error', $response['messages']);
            return redirect()->back();
        }
        else{
            
            session()->put('token', $response['token']);
            return redirect()->route('dashboard');
        }
    }

    public function dashboard(){
        
        $token = session()->get('token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => env('PUBLIC_URL').'/api/product/view',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $response = json_decode($response, true);
        
        $data =  $response['data'];
        
        return view('dashboard', compact('data'));
    }

    public function logout(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => env('PUBLIC_URL').'/api/logout',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        session()->flush('token');
        session()->flash('success', $response['messages']);
        return redirect()->route('login');
    }
}
