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
        'name', 'price', 'shortDescription', 'description', 'user_id', 'quantity'
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
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function scopeFilter($request)
    {
        if (request('name')) {
            $request->where('name', 'like', '%' . request('name') . '%');
        }
        if (request('price_from')) {
            $request->where('price', '>=', request('price_from'))->orderBy('price', 'asc');
        }
        if (request('price_to')) {
            $request->where('price', '<=', request('price_to'))->orderBy('price', 'asc');
        }
        if (request('time') == 'newest') {
            $request->orderBy('created_at', 'desc');
        }
        if (request('time') == 'oldest') {
            $request->orderBy('created_at', 'asc');
        }
        if (request('sort') == 'za') {
            $request->orderBy('name', 'desc');
        }
        if (request('sort') == 'az') {
            $request->orderBy('name', 'asc');
        }
        if (request('price') == 'giam') {
            $request->orderBy('price', 'desc');
        }
        if (request('price') == 'tang') {
            $request->orderBy('price', 'asc');
        }
        return $request;
    }
}
