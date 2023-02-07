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

    public function index(Request $request)
    {
        try {
            if(!empty($request->input('search'))){
                $search = $request->input('search');
                $datas = Product::with('images')->where('name', 'LIKE', "%{$search}%")->paginate(Paginations::SHOW_ITEMS);
            } else{
                $datas = Product::with('images')->paginate(Paginations::SHOW_ITEMS);
            }
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
}
