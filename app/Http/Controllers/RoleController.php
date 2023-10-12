<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {

     
      return view('admin.roles.index',[
        'roles_index'=>Role::all()
      
      ]);
    }

    public function store()
    {
      //مشان ما يحطا فاضية
      request()->validate
      ([
        'name'=>'required'
      ]);

      Role::create
      ([
      'name'=>Str::ucfirst(request('name')),
      'slug'=>Str::of(Str::lower(request('name')))->slug('_')
      ]);

     return back();
     //dd(request('name'));
     
    }

    public function delete(Role $role)
    {
    $role->delete();
    Session::flash('deleting_message','Role '.$role->name.' had deleted');
     
      return back();
    }

    public function edit(Role $role)
    {
      return view('admin.roles.edit',[
        'role_edit'=>$role,
        'perm_all'=>Permission::all()
    
    ]);
    }

    
    public function update(Role $role)
    {
      //dd($role);
      request()->validate
      ([
        'name'=>'required'
      ]);

     
      $role->name = Str::ucfirst(request('name'));
      $role->slug = Str::of(Str::lower(request('name')))->slug('_');

      if(!$role->isClean('name'))
      {
        Session::flash('updating_message','Role '.$role->id.' has updated');
        $role->save();

      }

      else
      {
        Session::flash('updating_message','Nothing has changed' );
      }

     
     
    //Session::flash('updating_message',$role->name);
     return redirect()->route('role.index');



    }


    public function attach(Role $role)
    {

      $role->permissions()->attach(request('permission'));
      return back();


     //dd(request('role'));
     // dd($user);
    }
    
    public function detach(Role $role)
    {

      $role->permissions()->detach(request('permission'));
      return back();


    }
    
  }

  

