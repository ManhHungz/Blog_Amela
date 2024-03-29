<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreatePaymentRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserShipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function payment(CreatePaymentRequest $request)
    {
        \DB::beginTransaction();
        try {
            $input = $request->all();
            $order = [
                'user_id' => Auth::user()->id,
                'total_amount' => $input['total_amount'],
                'status' => \App\Constants\Order::STATUS_ORDER_UNSHIP
            ];
            $product_ids = array_values(array_unique(array_column($input['obj'], 'product_id')));
            $products = Product::whereIn('id', $product_ids)->select('id', 'quantity')->get();
            $order = Order::create($order);
            UserShipping::create([
                'user_id' => Auth::user()->id,
                'name' => $input['name'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'order_id' => $order->id
            ]);
            foreach ($input['obj'] as $key => $obj) {
                $input['obj'][$key]['order_id'] = $order->id;
                $input['obj'][$key]['created_at'] = Carbon::now();
                $input['obj'][$key]['updated_at'] = Carbon::now();
                foreach ($products as $product) {
                    if ($obj['product_id'] == $product->id) {
                        Product::find($obj['product_id'])->update(['quantity' => ($product->quantity) - $obj['quantity']]);
                    }
                }
            }
            OrderDetail::insert($input['obj']);
            \DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Payment successfully!'
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
