<?php


namespace App\Services\CMS;


use App\Models\CategoriesProducts;
use App\Models\Category;

class CategoryService
{
    public function store($request){
        $status = false;
        $input = $request->all();
        if($request->hasFile('product_images')){
            $file = $request->file('category_image');
            $fileName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('images/categories',$fileName);
            $input['category_image'] = $storedPath;
            Category::create($input);
            $status = true;
        }
        return $status;
    }

    public function update($request, $id){
        $status = false;
        $input = $request->all();
        if($request->hasFile('category_image')){
            $file = $request->file('category_image');
            $fileName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('images/categories',$fileName);
            $input['category_image'] = $storedPath;
            Category::find($id)->fill($input)->save();
            $status = true;
        }
        return $status;
    }
}
