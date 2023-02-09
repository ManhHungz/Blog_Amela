<?php

namespace App\Http\Controllers\Api;

use App\Constants\Shipping;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateShippingAdress;
use App\Models\User;
use App\Models\UserShipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function user_address()
    {
        try {
            $user = User::find(Auth::user()->id)->shippings;
            return response()->json([
                'status' => 200,
                'data' => $user
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create_address(CreateShippingAdress $request)
    {
        try {
            $form_data = [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => Shipping::STATUS_SHIPPING_UNCHECK
            ];
            UserShipping::create($form_data);
            return response()->json([
                'status' => 200,
                'message' => 'Created address successfully!'
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function select_shipping($id)
    {
        try {
            UserShipping::find($id)
                ->fill(['status' => Shipping::STATUS_SHIPPING_CHECKED])
                ->save();
            DB::table('user_shippings')
                ->where('id', '!=', $id)
                ->update(['status' => Shipping::STATUS_SHIPPING_UNCHECK]);
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
