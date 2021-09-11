<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QueryUtility;

class DashboardController extends Controller
{
    
    public function index(){
        $products_count = QueryUtility::products($filter = [])->count();
        return view('admin.dashboard.index', compact('products_count'));
    }
}
