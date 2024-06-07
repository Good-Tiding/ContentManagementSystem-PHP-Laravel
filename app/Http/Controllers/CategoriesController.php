<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
  public function index()
  {
    return view('admin.categories.index',
    [
      'categories'=>Category::all() 
    ]); 
  }
  
  public function store(Request $request)
  {
    request()->validate
    ([
      'name'=>'required'
    ]);

    Category::create
    ([
    'name'=>Str::ucfirst(request('name')),
    // 'slug'=>Str::of(Str::lower(request('name')))->slug('_')
    ]);

    return back();
      
  }

    
    public function show(Category $category)
    {
      //  $category = Category::find($id);
        return view('admin.categories.show',compact('category'));
    }



    public function edit(Category $category)
{
    return view('admin.categories.edit', compact('category'));
}
        
    

    public function update(Request $request, Category $category)
{
    request()->validate
    ([
      'name'=>'required'
    ]);

    $category->name = Str::ucfirst(request('name'));
   // $category->slug = Str::of(Str::lower(request('name')))->slug('_');

    if(!$category->isClean('name'))
      {
        Session::flash('updating_message','Category '.$category->name.' has updated');
        $category->save();

      }

      else
      {
        Session::flash('updating_message','Nothing has changed' );
      }


    return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('deleting_message','Category '.$category->name.' had deleted');
        return redirect()->route('category.index');
    }
}
