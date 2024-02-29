<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'products';
    protected $casts = [
        'other_details' => 'object',
        'vehicle_details' => 'object'
    ];

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'image_path'
    ];
    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    public function product_images(){
        return $this->hasMany('App\Models\Product_image','product_id','id');
    }
    public function dealer(){
        return $this->hasOne('App\Models\Dealer','id','dealer_id');
    }
    public function user(){
        return $this->hasOne('App\Models\User','id','deleted_by');
    }
}
