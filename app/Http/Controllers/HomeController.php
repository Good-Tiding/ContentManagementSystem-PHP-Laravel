<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    public function __construct()
    {
       // مو ضروري اعمل لوغ ان لفوت وشوف صفحة الهوم لهيك علقناها
       // $this->middleware('auth');
    }
     public function index(Request $request)
    {
       return view('home');   
    } 


}
