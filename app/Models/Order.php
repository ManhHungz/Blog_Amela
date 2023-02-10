<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_amount', 'status'];

    public function sub_order()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function scopeSearch($request)
    {
        if (request('from_date')) {
            $request->where('created_at', '>=', request('from_date'))
                ->orWhere('created_at', '<=', request('to_date'))
                ->orderBy('created_at', 'asc');
        }
        return $request;
    }
}
