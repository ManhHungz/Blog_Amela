<?php


namespace App\Services\CMS;


use App\Models\CategoriesProducts;
use App\Models\Product;
use App\Models\ProductImages;

class ProductService
{
    public function store($request){
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
        return $status;
    }

    public function update($request, $id){
        $input = $request->all();
        $product = Product::find($id);
        $status = false;
        if($request->hasFile('product_images')){
            $files = $request->file('product_images');
            foreach ($files as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $storedPath = $file->storeAs('images/products', $fileName);
                $product_images = [
                    'product_id' => $id,
                    'product_image' => $storedPath
                ];
                $product->images()->create($product_images);
            }
        }
        $categories_id = $input['categories'];
        unset($input['categories']);
        unset($input['product_images']);
        if ($product->fill($input)->save()) {
            if(!empty($categories_id)){
                $product->categories()->sync($categories_id);
            }
            $status = true;
        }
        return $status;
    }
}
