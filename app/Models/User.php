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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   

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
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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
 
    /* public function getAvatarAttribute()
    {
       
    
    if(substr($this->attributes['avatar'],0,4) == 'http')
     return $this->attributes['avatar'];

    else
        return asset('/storage/'.$this->attributes['avatar']);
    
    }  */
    
    

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

  /*   public function assignRoleToUser(User $user)
{
    if (User::count() === 1) {
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $adminRole = Role::create([
                'name' => 'admin',
            ]);
        }

        $user->assignRole($adminRole);
    }
} */

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
