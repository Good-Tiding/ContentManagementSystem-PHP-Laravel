<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentReply extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function comment()
    {
     return $this->belongsTo(Comment::class);

    }

    public function photo()
    {
     return $this->belongsTo(Photo::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
