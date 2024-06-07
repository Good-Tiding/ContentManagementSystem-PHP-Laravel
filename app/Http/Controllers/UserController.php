<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Exception;

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
// Reusable method to update comments and replies
private function updateAuthorInfo($model, $userId, $newName, $newPhotoId)
 {
  $records = $model::where('user_id', $userId)->get();
  foreach ($records as $record) {
      $record->update([
          'author' => $newName,
          'photo_id' => $newPhotoId,
      ]);
  }
}
    public function update(User $user)
    { 
      
        $inputs=request()->validate
        ([
        'username'=>'required|string|max:255|alpha_dash',
        'name'=>'required|string|max:255',
        'email'=>'required|email|max:255|ends_with:@gmail.com,@hotmail.com',
        'photo_id' =>'file',
        //'password'=>'confirmed'
        ]);

        // Check if a password is provided,
    if (!empty(request('password'))) 
    {
      // Validate that the password is confirmed and matches
      request()->validate([
          'password' => 'required|confirmed|min:8', 
      ]);

      // Add the password to the $inputs array
       $inputs['password'] = request('password');
    }
    if (isset($inputs['password'])) {
          $user->password = $inputs['password'];
          //dd( $inputs );
    }

        if($file=request('photo_id'))
        {
          
          $name= time().$file ->getClientOriginalName();
          $file->move('users_profile_pic',$name);

            if ($user->userphoto &&  $user->userphoto->file != 'https://placehold.co/600x400' )
            {
              $fileName = basename($user->userphoto->file);

              // Construct the file path using the file name
              $filePath = public_path('users_profile_pic/' . $fileName);

              //Log::info("Trying to unlink the file: " . $filePath);
              // Delete the old image file from the server
              if (file_exists($filePath)) {
                // Attempt to delete the file and log the result
                if (unlink($filePath)) {
                    //Log::info("File successfully unlinked: " . $filePath);
                } else {
                    //Log::error("Failed to unlink the file: " . $filePath);
                }
            } else {
               // Log::error("File does not exist: " . $filePath);
            }
        
              // Update existing photo record
              $user->userphoto->update(['file' => $name]);
            }
            
            else 
            { 
              $photo = Photo::create(['file' => $name]);
            // Assign the new photo id as the user's profile photo id
            $user->photo_id = $photo->id;

            }  
           
        }    
      
      $user->username = $inputs['username'];
      $user->name = $inputs['name'];
      $user->email = $inputs['email'];

     // checking if the imageDeleted flag is set in the session. If the flag is not found, it defaults to false.
      $imageDeleted = session('imageDeleted', false);
//ضفنا ال|| لأنه التعديل عم يصير عالفايل يلي بقلب موديل الفوتو فهو عم يشوف تعديلات اليوزر يلي بقلب دول اليوزر ودغير يعرفن والاز ديرتي بتشتغل على الاتربيوت تبع الجدول يلي عم نعدل عليه فلهيك لازم نضيف الفوتو اي دي لنقله انو تغيرت الصورة
     if($user->isDirty() ||  request('photo_id') || $imageDeleted)
     {
      $user->save();


      $this->updateAuthorInfo(Comment::class, $user->id, $user->name, $user->photo_id);
      $this->updateAuthorInfo(CommentReply::class, $user->id, $user->name, $user->photo_id);
     
      Session::flash('updating_message','User '.$user->name.' profile has updated');
      session(['imageDeleted' => false]);
     }

     else
     {
      Session::flash('updating_message','Nothing has changed');
          }

     






      if (auth()->user()->UserHasRole('Admin')) 
      {
       return redirect()->route('profile.adminuser',$user->slug); 
      }
      else
      {
        return redirect()->route('profile.normaluser',$user->slug); 
      }
 
    } 
  
    public function index()
    {
    /*   $show_users = User::whereDoesntHave('roles', function ($query) {
        $query->where('name', 'Admin');
      })->paginate(2); */
      $show_users=User::paginate(2);
      return view('admin.users.index',compact('show_users'));
      
    }

    //مفروض هي بس للادمن لما بده يمسح يوزر تنمسح الصورة من الداتا والملف 
    public function delete(User $user)
    {
      $fileName = basename($user->userphoto->file);

      // Construct the file path using the file name
      $filePath = public_path('users_profile_pic/' . $fileName);
       // Check if the user has an image and it is not a placeholder
       if ($user->userphoto && $user->userphoto->file !== 'https://placehold.co/600x400')
         {
        // Delete the image file from the folder
       // $filePath = public_path() . $user->userphoto->file;
       Log::info("Trying to unlink the file: " . $filePath);
       if (file_exists($filePath)) 
       {
         if (unlink($filePath)) 
         {
           Log::info("File successfully unlinked: " . $filePath);
         } 
         else 
         {
             Log::error("Failed to unlink the file: " . $filePath);
         }
       }

       else 
       {
          Log::error("File does not exist: " . $filePath);
       }

        // Delete the photo record
        $user->userphoto->delete();
      }


      // ما زبطu nlink(public_path().$user->avatar);
      $user->delete();
      Session::flash('deleting_message','User '.$user->username.' had deleted');
      return back();
    }



    //اعتماددددد
    public function deleteuserimage(User $user)
    {
        try {
             $fileName = basename($user->userphoto->file);
         

              // Construct the file path using the file name
              $filePath = public_path('users_profile_pic/' . $fileName);
            // Check if the user has an image and it is not a placeholder
            if ($user->userphoto && $user->userphoto->file !== 'https://placehold.co/600x400') {
                // Delete the image file from the folder
            //    $filePath = public_path() . $user->userphoto->file;
                Log::info("Trying to unlink the file: " . $filePath);
                if (file_exists($filePath)) 
                {
                  if (unlink($filePath)) 
                  {
                    Log::info("File successfully unlinked: " . $filePath);
                  } 
                  else 
                  {
                      Log::error("Failed to unlink the file: " . $filePath);
                  }
                }

                else 
                {
                   Log::error("File does not exist: " . $filePath);
                }
    
                // Delete the photo record
                $user->userphoto->delete();
    
                // Set the photo_id attribute to null to remove the association
                $user->photo_id = null;

               // $this->imageDeleted = true;
               session(['imageDeleted' => true]);
                // Save the changes to the database
                $user->save();
                Session::flash('deleting_user_image_message','User '.$user->username.' image had deleted');
    
                //return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
            }
        } catch (Exception $e) {
            // Log the error
            Log::error('Failed to delete user image: ' . $e->getMessage());
    
            // Return an error response
           // return response()->json(['success' => false, 'message' => 'Failed to delete image'], 500);
        }
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

      return redirect()->route('admin.index');
    }
    public function show_profile_role(User $user)
    {
      $show_roles=Role::all();
      //dd($user->roles);
     return view('admin.users.attach _users_role_profile',compact('user','show_roles'));
   //   return view('user.profil.role.attach');
    }
    
   
  }
