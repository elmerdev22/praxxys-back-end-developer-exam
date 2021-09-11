<?php 

namespace App\Helpers;

use App\Models\Product;
use DB;

class QueryUtility{

    private static function where($filter, $data){
		if(isset($filter['where'])){
			$data = $data->where($filter['where']);
			
			return $data;
		}else{
			return false;
		}
	}

	private static function order_by_raw($filter, $data){
		if(isset($filter['order_by'])){
			$data = $data->orderByRaw($filter['order_by']);
			
			return $data;
		}else{
			return false;
		}
	}

	public static function products(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}

		$data = Product::with(['image'])->select($select);

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data = $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('products.name','like',"%{$value}%")
						->orWhere('products.description','like',"%{$value}%");
				}
            });
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

}