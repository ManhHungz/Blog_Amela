<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','price','shortDescription','description','user_id','quantity'
    ];

    /**
     * The products that are belong to the category
     *
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_products', 'product_id', 'category_id');
    }
    /**
     * The images that are belong to the product
     *
     */
    public function images(){
        return $this->hasMany(ProductImages::class, 'product_id','id');
    }

    public function cart_details(){
        return $this->hasMany(OrderDetail::class, 'product_id','id');
    }
}
