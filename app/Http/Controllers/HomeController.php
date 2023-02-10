<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexCus()
    {
//        return view('frontend.layouts.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexAdmin()
    {
        try {
            $orders = Order::all();
            $total_users = User::get()->count();
            $total_sale = array_sum(array_values(array_column($orders->toArray(), 'total_amount')));
            $total_orders = $orders->count();
            return view('layouts.dashboard', compact('total_users', 'total_orders', 'total_sale'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
