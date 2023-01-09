<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $datas = Category::orderBy('id','DESC')->paginate(5);
        return view('categories.index',compact('datas'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(CreateCategoryRequest $request){
        $input = $request->all();
        try {
            $file = $request->file('category_image');
            $fileName = $file->getClientOriginalName();
            $storedPath = $file->storeAs('images/categories',$fileName);
            $input['category_image'] = $storedPath;
            Category::create($input);
            return redirect()->route('categories.index');
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function view($id){
        $category = Category::find($id);
        return view('categories.view',compact('category'));
    }

    public function edit($id){
        $category = Category::find($id);
        return view('categories.edit',compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id){
        $input = $request->all();
        try {
            if(!empty($input['category_image'])){
                $file = $request->file('category_image');
                $fileName = $file->getClientOriginalName();
                $storedPath = $file->storeAs('images/categories',$fileName);
                $input['category_image'] = $storedPath;
            }
            Category::find($id)->fill($input)->save();
            return redirect()->route('categories.index');
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($id){
        try {
            Category::destroy($id);
            return redirect()->route('categories.index');
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
