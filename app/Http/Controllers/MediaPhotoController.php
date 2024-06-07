<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Log;
use App\Models\UploadPhoto;

class MediaPhotoController extends Controller
{
    
    public function index()
    {   
      
     $uploadphotos=auth()->user()->uploadphotos;
     return view("admin.mediaphoto.index",compact('uploadphotos'));
    }

    public function upload()
    {   
     
     return view("admin.mediaphoto.upload");

    }

    public function store(Request $request,UploadPhoto $uploadphoto)
    {
    $fileCounter = $request->input('fileCounter');


    $file= $request->file('file');

    if ($file) 
    {
        $name= time() .".". $file->getClientOriginalName();
       
        $file->move('uploaded_pic',$name);
   
      
   
    $uploadphoto = new UploadPhoto(['file' => $name]);
      auth()->user()->uploadphotos()->save($uploadphoto);
     
  
  }
     // Store the fileCounter value in the session
     session()->put('fileCounter', $fileCounter);
    return response()->json(['success' =>true]);
    }
    

public function destroychecked (Request $request)
{
  $uploadphotos=UploadPhoto::findOrFail($request->checkBoxArray);

     foreach($uploadphotos as $photo)
    {
      unlink(public_path().$photo->file);
      $photo->delete();
    } 
   Session::flash('deleting_checked_message',count($uploadphotos).' Photos had deleted');
   return redirect()->back();  
}
    
}
