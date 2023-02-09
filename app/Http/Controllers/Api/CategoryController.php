<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }

    public function index()
    {
        try {
            $datas = Category::all();
            return response()->json([
                'status' => 200,
                'data' => $datas,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function detailCategory($id)
    {
        try {
            $list_products = Category::find($id)->products->pluck('id');
            $list_products = Product::with('images')->whereIn('id', $list_products)->get();
            return response()->json([
                'status' => 200,
                'data' => $list_products,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
