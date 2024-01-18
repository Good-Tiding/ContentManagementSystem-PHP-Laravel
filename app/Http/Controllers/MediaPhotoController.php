<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MediaPhotoController extends Controller
{
    
    public function index()
    {   
        $photos=Photo::all();
        $users=User::all();
     return view("admin.mediaphoto.index",compact('photos','users'));

  

    }

    public function upload()
    {   
       
        return view("admin.mediaphoto.upload");

    }

    public function store(Request $request)
    {

    $file= $request->file('file');
    $name= time() .".". $file->getClientOriginalName();

    $file->move('images_model',$name);
    Photo::create(['file'=>$name]);
  //  echo ('uploaded');
  // return redirect()->route('mediaphoto.index');

  // return redirect('/admin')->with('success','uploaded successfully');

    }
  
public function destroy(Photo $photo)
{
    unlink(public_path().$photo->file);
    $photo->delete();
  Session::flash('deleting_message','Photo '.$photo->id.' had deleted');
    return back();
   
//echo ('no photo to delete');

}

public function destroychecked (Photo $photo)
{
   unlink(public_path().$photo->file);
  $photo->delete();

  Session::flash('deleting_checked_message','Photo '.count($photo->id). 'had deleted');
    return back();

    //return 'working';

}
    
}
