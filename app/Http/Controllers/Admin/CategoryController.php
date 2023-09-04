<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
   public function index()
   {

    return view ('category.index');

   }

  public function create()
  {

    return view('category.create');
  }

  public function store(CategoryFormRequest $request)
  {
    $validatedData= $request->validated();
    $category = new category;
    $category->name= $validatedData['name'];
    $category->slug= str::Slug($validatedData['slug']);
    $category->description= $validatedData['description'];

    if($request->hasFile('image')){
        $file= $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename= time() . ' . ' . $ext;
        $file=move_uploaded_file('uploads/Category',$filename);
        $category->image= $filename;
}

    $category->meta_title= $validatedData['meta_title'];
    $category->meta_keyword= $validatedData['meta_keywords'];
    $category->meta_description= $validatedData['meta_description'];
    $category->status= $request->status==true ? '1':'0';
    $category->Save();

    return redirect('admin/category')->with('message','Category Added Successfully');
  }



}
