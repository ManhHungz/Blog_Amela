<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\CategoriesProducts;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $datas = Product::orderBy('id', 'DESC')->paginate(5);
        return view('products.index', compact('datas'));
    }

    public function create()
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();
        return view('products.create', compact('categories'));
    }

    public function view($id)
    {
        $product = Product::find($id);
        $product_categories = implode(', ', array_values(array_unique(array_column($product->categories->toArray(), 'name'))));
        $product_images = array_values(array_unique(array_column($product->images->toArray(), 'product_image')));
        return view('products.view', compact('product', 'product_categories', 'product_images'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $product_categories = array_values(array_unique(array_column($product->categories->toArray(), 'id')));
        $product_images = array_values(array_unique(array_column($product->images->toArray(), 'product_image')));
        return view('products.edit', compact('product', 'categories', 'product_categories', 'product_images'));
    }

    public function store(CreateProductRequest $request)
    {
        try {
            $status = false;
            $input = $request->all();
            $files = $request->file('product_images');
            $categories_id = $input['categories'];
            unset($input['categories']);
            unset($input['product_images']);
            if (!empty($files) && ($product = Product::create($input))) {
                foreach ($files as $key => $file) {
                    $fileName = $file->getClientOriginalName();
                    $storedPath = $file->storeAs('images/products', $fileName);
                    $product_images[] = [
                        'product_id' => $product->id,
                        'product_image' => $storedPath
                    ];
                }
                $status = true;
            }
            if (!empty($product_images) && !empty($categories_id) && (ProductImages::insert($product_images))) {
                foreach ($categories_id as $category_id) {
                    $product_categories[] = [
                        'category_id' => $category_id,
                        'product_id' => $product->id
                    ];
                }
                if (!empty($product_categories)) {
                    CategoriesProducts::insert($product_categories);
                    $status = true;
                }
            }
            if ($status == true) {
                return redirect()->route('products.index');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $input = $request->all();
            $product = Product::find($id);
            $categories_id = $input['categories'];
            $status = false;
            if($request->hasFile('product_images')){
                $files = $request->file('product_images');
                $images = array_values(array_unique(array_column($product->images->toArray(), 'product_image')));
                Storage::disk('images')->delete($images);
                foreach ($files as $key => $file) {
                    $fileName = $file->getClientOriginalName();
                    $storedPath = $file->storeAs('images/products', $fileName);
                    $product_images[] = [
                        'product_image' => $storedPath
                    ];
                }
            }
            $categories_id = $input['categories'];
            unset($input['categories']);
            unset($input['product_images']);
            if ($product->fill($input)->save()) {
                if(!empty($product_images)){
                    \DB::table('product_images')->where('product_id',$id)->update($product_images);
                }
                if(!empty($categories_id)){
                    $product->categories()->sync($categories_id);
                }
                $status = true;
            }
            if ($status == true) {
                return redirect()->route('products.index');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($id){
        try {
            Product::find($id)->delete();
            return redirect()->route('products.index')->with('message','Deleted successfully');
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function test()
    {

    }
}
