<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use Cviebrock\EloquentSluggable\Sluggable;



class Post extends Model 

{
    use HasFactory;
    use Sluggable;
 


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'      => 'title',
                'onUpdate'    => true,
            ],
           
        ];
    }




    protected $guarded=[];


    public function user()
    {
     return $this->belongsTo(User::class);

    }


    public function category()
    {
     return $this->belongsTo(Category::class);

    }


    public function comments()
    {
     return $this->hasMany(Comment::class);

    }
   

       
       public function getPostImageAttribute($value)
       {
           if ($value) 
           {
               if (substr($value, 0, 4) == 'http') 
               {
                   return $value; // Return the image URL as it is
               } 
               else 
               {
                   return asset('/storage/' . $value); // Return the image URL with storage path
               }
           } 
           else
            {
               return 'https://placehold.co/600x400'; // Return placeholder image URL for null values
            }
       }

    


    
    public function getRouteKeyName ()
    {
        return 'slug';
    }

 

    

    
  
}
