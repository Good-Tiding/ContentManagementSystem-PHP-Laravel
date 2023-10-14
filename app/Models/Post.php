<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   /*  protected $fillable = [
        'title',
        'post_image',
        'body',
    ]; */

    protected $guarded=[];


    public function user()
    {
     return $this->belongsTo(User::class);

    }


    public function category()
    {
     return $this->belongsTo(Category::class);

    }

    /*   public function setPostImageAttribute($value)
    {

        $this->attributes['post_image'] = asset($value);
    
    } */

    public function getPostImageAttribute()
    {
       /* if(substr($value,0,2) == 'ht')
	            return $value;
        else                       
       return asset('/storage/'.$value); */ 
        
       //dd(asset($value));
    
    if(substr($this->attributes['post_image'],0,4) == 'http')
     return $this->attributes['post_image'];

    else
        return asset('/storage/'.$this->attributes['post_image']);
    
    } 

  
}
