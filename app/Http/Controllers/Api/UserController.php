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

    public function getOrder()
    {
        try {
            $order_detail_ids = User::find(Auth::user()->id)->orderDetail()->pluck('product_id')->toArray();
            $order_detail_ids = array_values(array_unique($order_detail_ids));
            $products = Product::with('orderProducts')->whereIn('id', $order_detail_ids)->get()->toArray();
            return response()->json([
                'status' => 200,
                'data' => $products
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
