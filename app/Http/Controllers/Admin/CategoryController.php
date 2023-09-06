<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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

public function edit(Category $category = null)
{
  return view('category.edit',compact('$category'));
}

public function update(CategoryFormRequest $request, $category)
{
  $validatedData= $request->validated();

  $category = Category::findOrFail($category);
  
    $category->name= $validatedData['name'];
    $category->slug= str::Slug($validatedData['slug']);
    $category->description= $validatedData['description'];

    if($request->hasFile('image')){

      $path = 'uploads/Category'.$category->image;
      if(File::exists($path)){
        File::delete($path);
      }
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
    $category->update();

    return redirect('admin/category')->with('message','Category Updated Successfully');
  }

}
