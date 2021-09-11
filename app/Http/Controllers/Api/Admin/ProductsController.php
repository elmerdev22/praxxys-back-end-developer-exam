<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use QueryUtility;
use Storage;
use DB;

class ProductsController extends Controller
{
    public function index(Request $request){
        
        $filter = [];
        
		if($request->search){
			$filter['or_where_like'] = $request->search;
		}
		if($request->category){
			$filter['where']['products.category_id'] = $request->category;
		}

        $filter['order_by'] = 'created_at desc';

        $data = QueryUtility::products($filter)->paginate(10);

        return response()->json($data, 200);      
    }

    public function delete($id){
        $data = Product::whereId($id)->delete();
        return response()->json($data);      
    }

    public function create(Request $request){
       
        $response = ['success' => false, 'message' => ''];
        
        DB::beginTransaction();

        try{
            $data              = new Product();
            $data->name        = $request->name;
            $data->category_id = $request->category;
            $data->description = $request->description;
            $data->datetime    = $request->datetime;
            if($data->save()){
                if($request->hasFile('images')){
                    foreach($request->file('images') as $image){
                        $name = time().rand(1, 100).'.'.$image->extension();
                        $image->move(public_path('products'), $name);  
                        Image::create([
                            'product_id' => $data->id,
                            'name'       => $name
                        ]);
                    }
                }
                $response['success'] = true;
                $response['message'] = 'Successfully Created!';
            }
        }catch(\Exception $e){
            $response['message'] = $e;
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
        }else{
            DB::rollback();
        }

        return response()->json($response, 200);   
    }
    
    public function update(Request $request, $id){

        $response = ['success' => false, 'message' => ''];
        
        DB::beginTransaction();

        try{
            $data              = Product::whereId($id)->first();
            $data->name        = $request->name;
            $data->category_id = $request->category;
            $data->description = $request->description;
            $data->datetime    = $request->datetime;
            if($data->save()){
                $current_img_remove = explode(',', $request->currentImagesRemove);
                if(count($current_img_remove) > 0){
                    foreach($current_img_remove as $image_id){
                        Image::whereId($image_id)->delete();
                    }
                }
                if($request->hasFile('images')){
                    foreach($request->file('images') as $image){
                        $name = time().rand(1, 100).'.'.$image->extension();
                        $image->move(public_path('products'), $name);  
                        Image::create([
                            'product_id' => $data->id,
                            'name'       => $name
                        ]);
                    }
                }
                $response['success'] = true;
                $response['message'] = 'Successfully Updated';
            }
        }catch(\Exception $e){
            $response['message'] = $e;
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
        }else{
            DB::rollback();
        }

        return response()->json($response, 200);   
    }

    public function edit($id){
        
        $filter = [];
        $filter['where']['products.id'] = $id;
        $data = QueryUtility::products($filter)->first();

        return response()->json($data, 200);      
    }
}
