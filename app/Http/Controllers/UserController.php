<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show_admin_profile(User $user)
    {
     $show_roles=Role::all();
      //dd($user->roles);
     return view('admin.users.profile',compact('user','show_roles'));
    }

    public function show_user_profile(User $user)
    {
    
      //dd($user->roles);
     return view('admin.users.normal_profile',compact('user'));
    }

 

   


    public function update(User $user)
    {

     
        
        $inputs=request()->validate
        ([
        'avatar' =>'file',
        'username'=>'required|string|max:255|alpha_dash',
        'name'=>'required|string|max:255',
        'email'=>'required|email|max:255',
        'photo_id' =>'file',
        //'password'=>'confirmed'
        
        ]);

        if(trim(request('password')==''))
        {
       $inputs =request()->except('password');
  
       //dd( $inputs );
  
        }
        
  
        else
        {
          $inputs =request()->all();
          $inputs['password']=(request('password'));
          $user->password = $inputs['password'];
          //dd( $inputs );
        }
        

      

       

        if($file=request('photo_id'))
        {
          //dd(request('avatar'));
          $name= time().$file ->getClientOriginalName();
          $file->move('images_model',$name);

          $photo=Photo::create(['file'=>$name]);

          $inputs['photo_id']=$photo->id;

          $user->photo_id = $inputs['photo_id'];

           //return 'photo exist';
        } 
        //فينا بدال ما نحدط كل هدول الانبوت بعد ما شيكنا عالصور هدول الانبتس يعتبروا كلن ايلس
        //المهم فينا نقول
        //User::create($inputs);
     
        if(request('avatar'))
      {
        //dd(request('avatar'));
           $inputs['avatar']=request('avatar')->store('images');
          $user->avatar = $inputs['avatar'];
      }
      
      
      $user->username = $inputs['username'];
      $user->name = $inputs['name'];
      $user->email = $inputs['email'];
      //$user->password= $inputs['password'];
     //auth()->user()->posts()->save($post);
      //$this->authorize('update',$user);
      $user->save();
     Session::flash('updating_message','User '.$user->name.' profile has updated');
     return back(); 
       
        
    }

    public function index()
    {
      $show_users=User::all();
      return view('admin.users.index',compact('show_users'));
    }

    public function delete(User $user)
    {
      unlink(public_path().$user->photo->file);


      // ما زبطu nlink(public_path().$user->avatar);
      $user->delete();
      Session::flash('deleting_message','User '.$user->username.' had deleted');
      return back();
    }



    public function attach(User $user)
    {

      $user->roles()->attach(request('role'));
      return redirect()->route('index.users');
    


     //dd(request('role'));
     // dd($user);
    }
    public function detach(User $user)
    {

      $user->roles()->detach(request('role'));
      return redirect()->route('index.users');
    }

    
   
  }
