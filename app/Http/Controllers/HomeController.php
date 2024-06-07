<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // مو ضروري اعمل لوغ ان لفوت وشوف صفحة الهوم لهيك علقناها
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(Request $request)
    {
       /*  $categories=Category::all();
       // $posts = Post::Paginate(3);
       // $query = '';
        $query = $request->input('query'); */


        
         return view('home');
        
    } 

   /*  public function search()
    {
             
    
     
        // Filter posts based on the search query
        //$results = Post::where('title', 'like', '%'.$query.'%')->get();
                      /* ->orWhere('body', 'like', '%'.$query.'%') */
                   
                      //$search = $request->input('search');
                    // $results = Product::where('name', 'like', "%$search%")->get();
                  /* 
                    return view('home', compact( 'query')); }*/
          
    


}
