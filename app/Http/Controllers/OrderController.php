<?php

namespace App\Http\Controllers;

use App\Constants\Paginations;
use App\Constants\Shipping;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserShipping;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $datas = Order::orderBy('id', 'DESC')->search()->paginate(Paginations::ADMIN_SHOW_ITEMS);
            $user_ids = $datas->pluck('user_id');
            $users = User::whereIn('id', $user_ids)->get()->toArray();
            foreach ($datas as $data) {
                foreach ($users as $user) {
                    if ($user['id'] == $data['user_id']) {
                        $data['name'] = $user['name'];
                        $data['email'] = $user['email'];
                    }
                }
                if ($data['status'] == \App\Constants\Order::STATUS_ORDER_UNSHIP) {
                    $data['status_title'] = 'Đơn hàng chưa gửi';
                }
                if ($data['status'] == \App\Constants\Order::STATUS_ORDER_SHIP) {
                    $data['status_title'] = 'Đã gửi';
                }
                if ($data['status'] == \App\Constants\Order::STATUS_ORDER_REFUSE) {
                    $data['status_title'] = 'Từ chối đơn hàng';
                }
            }
            return view('orders.index', compact('datas'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function view($id)
    {
        try {
            $order = Order::find($id);
            $shipping = DB::table('user_shippings')
                ->select('name', 'phone', 'address')
                ->where([
                'user_id' => $order->user_id,
                'status' => Shipping::STATUS_SHIPPING_CHECKED])
                ->first();
            $sub_orders = $order->sub_order;
            $product_ids = $sub_orders->pluck('product_id');
            $products = Product::whereIn('id', $product_ids)->get()->toArray();
            foreach ($sub_orders as $sub_order) {
                foreach ($products as $product) {
                    if ($product['id'] == $sub_order['product_id']) {
                        $sub_order['product_title'] = $product['name'];
                        $sub_order['product_price'] = $product['price'];
                    }
                }
            }
            return view('orders.view', compact('sub_orders','shipping'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function complete($id)
    {
        $cart = Order::find($id);
        $cart->fill(['status' => 1])->save();
        return redirect()->route('orders.index')->with('flash_message', 'Change status successfully!');;
    }

    public function refuse($id)
    {
        $cart = Order::find($id);
        $cart->fill(['status' => -1])->save();
        return redirect()->route('orders.index')->with('flash_message', 'Change status successfully!');;
    }
}
