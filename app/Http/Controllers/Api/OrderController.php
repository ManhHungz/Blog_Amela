<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function payment(Request $request)
    {
        \DB::beginTransaction();
        try {
            $input = $request->all();
            $order = [
                'user_id' => Auth::user()->id,
                'total_amount' => $input['total_amount'],
                'status' => \App\Constants\Order::STATUS_ORDER_UNSHIP
            ];
            $order = Order::create($order);
            foreach ($input['obj'] as $key => $obj) {
                $input['obj'][$key]['order_id'] = $order->id;
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
