<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user)
    {
        //
    }
    public function view(User $user, Post $post)
    {
        // فينا نحطا ازا بدنا كل ادمن يعدل على ادمن
        /*  if ($user->UserHasRole('Admin'))
        {
         return true;
        } 
         */
        return $user->id == $post->user_id || $user->UserHasRole('Admin');
    }

    public function create(User $user)
    {
       // return true;
       return $user->is($user);
    }

    public function update(User $user, Post $post)
    {
       
        return $user->id == $post->user_id || $user->UserHasRole('Admin') ;

    } 

   

    
    public function delete(User $user, Post $post)
    {
       
        return $user->id == $post->user_id || $user->UserHasRole('Admin');
    }

    public function restore(User $user, Post $post)
    {
        //
    }
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
