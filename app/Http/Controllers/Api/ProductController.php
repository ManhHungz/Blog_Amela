<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function index(){
        try {
            $datas = Product::with('images')->get();
            return response()->json([
                'status' => 'success',
                'data' => $datas,
            ]);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function detailProduct($id){
        try {
            $list_image = Product::with('images')->find($id);
            return response()->json([
                'status' => 'success',
                'data' => $list_image,
            ]);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function search($search){
        dd(1);
        $product = Product::query()->where('name', 'LIKE', "%{$search}%");
        dd($product);
    }
}
