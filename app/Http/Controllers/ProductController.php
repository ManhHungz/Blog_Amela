<?php

namespace App\Http\Controllers;

use App\Constants\Paginations;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\CategoriesProducts;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Services\CMS\ProductService;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $datas = Product::orderBy('id', 'DESC')->paginate(Paginations::SHOW_ITEMS);
            return view('products.index', compact('datas'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = Category::all()->pluck('name', 'id')->toArray();
            return view('products.create', compact('categories'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function view($id)
    {
        try {
            $product = Product::find($id);
            $product_categories = implode(', ', array_values(array_unique(array_column($product->categories->toArray(), 'name'))));
            $product_images = array_values(array_unique(array_column($product->images->toArray(), 'product_image')));
            return view('products.view', compact('product', 'product_categories', 'product_images'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::find($id);
            $categories = Category::all();
            $product_categories = array_values(array_unique(array_column($product->categories->toArray(), 'id')));
            $product_images = array_values(array_unique(array_column($product->images->toArray(), 'product_image')));
            return view('products.edit', compact('product', 'categories', 'product_categories', 'product_images'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function store(CreateProductRequest $request)
    {
        \DB::beginTransaction();
        try {
            $status = $this->service->store($request);
            if ($status == true) {
                \DB::commit();
                return redirect()->route('products.index')->with('flash_message', 'Product created successfully!');;
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $status = $this->service->update($request, $id);
            if ($status == true) {
                \DB::commit();
                return redirect()->route('products.index')->with('flash_message', 'Product updated successfully!');
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Product::find($id)->delete();
            return redirect()->route('products.index')->with('flash_message', 'Deleted successfully');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
