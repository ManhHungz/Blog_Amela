<?php


namespace App\Http\Controllers\Api;

use App\Constants\Paginations;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function index()
    {
        try {
            $datas = Product::with('images')->get()->paginate(Paginations::SHOW_ITEMS);
            return response()->json([
                'status' => 'success',
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
                'status' => 'success',
                'data' => $list_image,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search($name)
    {
        try {
            $product = Product::with('images')->where('name', 'LIKE', "%{$name}%")->get();
            return response()->json([
                'status' => 'success',
                'data' => $product
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
