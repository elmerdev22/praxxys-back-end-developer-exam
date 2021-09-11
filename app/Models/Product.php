<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Utility;

class Product extends Model
{
    use HasFactory;

	protected $appends = ['category'];

    public function getCategoryAttribute(){
        $categories = Utility::categories();
        return $categories[$this->attributes['category_id']];
    }

    public function image(){
        return $this->hasMany('App\Models\Image', 'product_id', 'id');
    }
}
