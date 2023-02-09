<?php


namespace App\Services\CMS;


use App\Models\CategoriesProducts;
use App\Models\Category;

class CategoryService
{
    public function store($request){
        $input = $request->all();
        if($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $fileName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('images/categories', $fileName);
            $input['category_image'] = $storedPath;
            Category::create($input);
        }
    }

    public function update($request, $id){
        $input = $request->all();
        if($request->hasFile('category_image')){
            $file = $request->file('category_image');
            $fileName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('images/categories',$fileName);
            $input['category_image'] = $storedPath;
        }
        Category::find($id)->fill($input)->save();
    }
}
