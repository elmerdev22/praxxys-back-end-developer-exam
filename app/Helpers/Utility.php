<?php 

namespace App\Helpers;

use App\Models\{User};
use Auth;
use DB;

class Utility{

    public static function authUserAdmin(){
        if(Auth::check()){
            if(Auth::user()->type == 'admin'){
                return User::where('id', Auth::user()->id)->first();
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public static function categories(){
        return [
            1 => 'Clothes',
            2 => 'Car',
            3 => 'Food',
            4 => 'Gadgets',
            5 => 'Appliances',
        ];
    }

}