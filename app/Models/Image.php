<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

	protected $appends  = ['image_link'];
	protected $fillable = ['product_id', 'name'];
    
    public function product(){
        return $this->belongsTo('App\Models\Product', 'id', 'product_id');
    }

    public function getImageLinkAttribute(){
        return url('/products/'.$this->attributes['name']);
    }
}
