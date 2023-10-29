<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['file'];

    protected $uploaded = '/images_model/';

   // protected $uploadeddropzone = '/dropzone_media/';


    public function getFileAttribute($photo)

    {

        return $this->uploaded. $photo;
    }


   
  

}
