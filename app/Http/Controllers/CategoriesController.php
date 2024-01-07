<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /// $categories=Category::all();
       // return view(['components.home-master','admin.categories.index'], compact('categories'));
       // return view('components.home-master', [$categories]);
          return view('admin.categories.index',[
            'categories'=>Category::all() 
          
         ]); 
  /*        $categories=Category::all();
        return  View::share('admin.categories.index', compact('categories')  ); */

       //  View::share('categories', Category::OrderBy('sortOrder', 'asc')->get());
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate
        ([
          'name'=>'required'
        ]);
        Category::create
        ([
        'name'=>Str::ucfirst(request('name')),
        
        ]);

        return back();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_edit = Category::find($id);
        return view('admin.categories.edit',compact('category_edit'));
           
          
    }
        
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category_edit = Category::find($id);
        $category_edit->name =Str::ucfirst(request('name'));
        $category_edit->save();
        return redirect()->route('index.create');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);


        $category->delete();
        Session::flash('deleting_message','Category '.$category->name.' had deleted');
         
          return back();
    }
}
