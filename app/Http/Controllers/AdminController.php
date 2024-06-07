<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\UploadPhoto;
use App\Models\Permission;
use App\Models\Role;
use App\Models\CommentReply;
class AdminController extends Controller
{
    public function index(Comment $comment,Post $post)
    {
        if (auth()->user()->UserHasRole('Admin'))
        {
            $UserCount=User::count();
            $PostCount=Post::count();
            $CategoryCount=Category::count();
            $RoleCount=Role::count();
          /*   $PermissionCount=Permission::count(); */
            $MediaCount=UploadPhoto::count();
            // Get all users with their respective photo counts
            $users = User::withCount('uploadphotos')->get();
    
            // Create an array of user names and photo counts
            $mediaCounts = $users->mapWithKeys(function ($user) {
                return [$user->name => $user->uploadphotos_count];
            });
    
            //'mediaCounts',,'PermissionCount'
            return view('admin.index', compact( 'UserCount','PostCount','MediaCount','CategoryCount','RoleCount','users'));
        }
    
    
        else
        {
            $MediaCount = auth()->user()->uploadphotos()->count();
            $PostCount  = auth()->user()->posts()->count();
          
            
            $CommentCount = auth()->user()->authcomments()->where('is_active', 1)->count();
            
            $replyCount = auth()->user()->comments()->with('replies')->get()->pluck('replies')->flatten()->where('is_active', 1)->count();
            
           return view('admin.index',compact('PostCount','MediaCount','CommentCount','replyCount')); 
                                      
        }
    }
      
    }

