<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginRedirectController extends Controller
{
    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->type == 'admin'){
                return redirect(route('admin.dashboard.index'));
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
}
