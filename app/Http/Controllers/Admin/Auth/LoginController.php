<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Session;
 
class LoginController extends Controller
{
    public function login(Request $request){

        if($request->getMethod() == 'GET'){
            return view('auth.login');
        }
        else{

            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            
            $validator = Validator::make($request->all(), $rules);
            
            // if the validator fails, redirect back to the form
            if ($validator->fails()) {
                return redirect()->route('admin.login')->withErrors($validator)->withInput();
            } else {
                
                $fields   = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
                $remember = $request->remember ? true : false;

                $auth = [
                    $fields    => $request->username,
                    'password' => $request->password
                ];

                if (Auth::attempt($auth, $remember)){
                    return redirect(route('login-redirect.index'));
                } else {        
                    Session::flash('error', 'Incorrect Username or Password.');
                    return back()->withInput();
                }
            }
        }
    }
}
