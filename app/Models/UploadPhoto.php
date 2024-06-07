<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPhoto extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $uploaded = '/uploaded_pic/';

   // protected $uploadeddropzone = '/dropzone_media/';


    public function getFileAttribute($photo)

    {

        return $this->uploaded. $photo;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
