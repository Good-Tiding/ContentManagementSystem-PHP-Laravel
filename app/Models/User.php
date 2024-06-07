<?php

namespace App\Models;
use Illuminate\Support\Facades\Log;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    
   

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'      => 'name',
                'onUpdate'    => true,
            ],
           
        ];
    }

    protected $guarded =[];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($value)
    {
        if(!empty($value))
        {
            $this->attributes['password'] = bcrypt($value);
        }
    }
 
    
    

    /* public function permissions()
    {
     return $this->belongsToMany(Permission::class);

    } */

/*     public function hasPermission($permission)
{
    foreach ($this->roles as $role) {
        if ($role->permissions->contains('name', $permission)) {
            return true;
        }
    }
    return false;
} */

    public function roles()
    {
     return $this->belongsToMany(Role::class);

    }

    public function UserHasRole($role_name)
    {
      
     foreach($this->roles as $role)
     {
       if(Str::lower($role_name)  ==  Str::lower($role->name))
       {
         return true;
       }

     }
     return false;

    }

 
     public function assignRole($role)
{
   // Log::info('Assigning role to user: ' . $this->id);
    if (is_string($role)) {
        $role = Role::where('name', $role)->first();
    }
   // Log::info('Role assigned to user: ' . $this->id);
    return $this->roles()->attach($role);
}  



     public function uploadphotos()
    {
     return $this->hasMany(UploadPhoto::class);

    } 

    public function userphoto()
    {
        
        return $this->hasOne(Photo::class, 'id', 'photo_id');
     
    }

    
     public function getRouteKeyName ()
    {
        return 'slug';
    } 
  
    public function posts()
    {
     return $this->hasMany(Post::class);

    }
    public function comments()
    {
     return $this->hasManyThrough(Comment::class, Post::class);
    }


    public function authcomments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function authreplies()
    {
        return $this->hasMany(CommentReply::class);
    }
 




}
