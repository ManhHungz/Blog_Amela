<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('api');
    }
    public function index(){
        try {
            $datas = Category::all();
            return response()->json([
                'status' => 'success',
                'data' => $datas,
            ]);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function detailCategory($id){
        try {
            $list_products = Pro::find($id)->products;
            return response()->json([
                'status' => 'success',
                'data' => $list_products,
            ]);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
