<?php

namespace App\Http\Controllers;

use App\Constants\Paginations;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Services\CMS\CategoryService;

class CategoryController extends Controller
{
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(){
        try {
            $datas = Category::orderBy('id','DESC')->paginate(Paginations::SHOW_ITEMS);
            return view('categories.index',compact('datas'));
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function create(){
        try {
            return view('categories.create');
        } catch (\Exception $e){
        throw new \Exception($e->getMessage());
        }
    }

    public function store(CreateCategoryRequest $request){
        \DB::beginTransaction();
        try {
            $this->service->store($request);
            \DB::commit();
            return redirect()->route('categories.index')->with('flash_message','Created category successfully');
        }catch (\Exception $e){
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function view($id){
        try {
            $category = Category::find($id);
            return view('categories.view',compact('category'));
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function edit($id){
        try {
            $category = Category::find($id);
            return view('categories.edit',compact('category'));
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateCategoryRequest $request, $id){
        \DB::beginTransaction();
        try {
            $this->service->update($request);
            \DB::commit();
            return redirect()->route('categories.index')->with('flash_message','Updated category successfully');
        }catch (\Exception $e){
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($id){
        \DB::beginTransaction();
        try {
            Category::destroy($id);
            \DB::commit();
            return redirect()->route('categories.index');
        }catch (\Exception $e){
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
