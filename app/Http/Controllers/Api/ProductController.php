<?php

namespace App\Http\Controllers\Api;

use App\Constants\Paginations;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function index()
    {
        try {
            $datas = Product::with(['categories', 'images'])->filter()->paginate(Paginations::CUS_SHOW_ITEMS);
            return response()->json([
                'status' => 200,
                'data' => $datas,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function detailProduct($id)
    {
        try {
            $list_image = Product::with('images')->find($id);
            return response()->json([
                'status' => 200,
                'data' => $list_image,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
