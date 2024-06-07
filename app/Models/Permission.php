<?php

/* namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Permission extends Model
{
    use HasFactory,Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'      => 'name',
                'onUpdate'    => true,
            ],
           
        ];
    }

    protected $guarded=[];
    
    public function users()
    {
     return $this->belongsToMany(User::class);

    }

    public function roles()
    {
     return $this->belongsToMany(Role::class);

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }  
} */
