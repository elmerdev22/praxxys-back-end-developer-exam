<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utility;

class ProductsController extends Controller
{
    public function index(){
        $categories = self::categories();
        return view('admin.products.index', compact('categories'));
    }

    public function create(){
        $categories = self::categories();
        return view('admin.products.create', compact('categories'));
    }

    public function edit($id){
        $categories = self::categories();
        return view('admin.products.edit', compact('categories', 'id'));
    }

    public function categories(){
        return Utility::categories();
    }
}
