<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Cviebrock\EloquentSluggable\Sluggable;


class Role extends Model
{
    use HasFactory;
    use Sluggable;
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
    
   /*  public function permissions()
    {
     return $this->belongsToMany(Permission::class);

    }
 */
    public function users()
    {
     return $this->belongsToMany(User::class);

    }

    public function getRouteKeyName ()
    {
        return 'slug';
    }
}
