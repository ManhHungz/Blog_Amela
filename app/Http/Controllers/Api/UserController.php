<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function view()
    {
        try {
            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $storedPath = $file->storeAs('images/users', $fileName);
            }
            $data_user = $user->fill(
                [
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'image' => isset($storedPath) ? $storedPath : '',
                ]
            )->save();
            return response()->json([
                'status' => 200,
                'message' => 'Update your account successfully!',
                'data' => $data_user
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function get_orders()
    {
        try {
            $orders = User::find(Auth::user()->id)->orders()->get();
            return response()->json([
                'status' => 200,
                'data' => $orders
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function order_detail($id)
    {
        try {
            $order = Order::with('sub_order')->find($id)->toArray();
            $product_ids = array_values(array_column($order['sub_order'], 'product_id'));
            $products = Product::whereIn('id', $product_ids)->get();
            foreach ($order['sub_order'] as $key => $sub) {
                foreach ($products as $product) {
                    if ($sub['product_id'] == $product->id) {
                        $order['sub_order'][$key]['product_name'] = $product->name;
                        $order['sub_order'][$key]['product_price'] = $product->price;
                    }
                }
            }
            return response()->json([
                'status' => 200,
                'data' => $order
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
