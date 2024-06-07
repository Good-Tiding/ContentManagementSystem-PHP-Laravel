<?php

namespace App\Http\Controllers;

use App\Models\CommentReply;
use App\Models\Comment;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentsRepliesController extends Controller
{
    public function store(Request $request)
    {
        $user=Auth::user();
        $isAdmin=auth()->user()->UserHasRole('Admin');
        $photoId = $user->userphoto ? $user->userphoto->id : 'https://placehold.co/600x400';

        $data=[
            'comment_id' => $request->comment_id,
            //لما ضفت اليوزر اي دس للجدول نسيت ضيفههون وطلعلي مشكلة 
            // Cannot add or update a child row: a foreign key constraint fails
            'user_id' => $user->id,
            'author' => $user->name,
            'email' => $user->email,
 
           'photo_id'=>  $photoId,
            'body' => $request->body, 
            'is_active' => $isAdmin ? 1 : 0, 
        ]; 
        CommentReply::create($data);
     
       if($isAdmin)
       {
         session()->flash('reply_message','Your reply has posted, you are the admin!!');
       }
      else
      {
        session()->flash('reply_message','Your reply has been submitted and it is waiting for moderation');

      }
      
       return redirect()->back();
    }

   
    public function show(Comment $comment)
    {
  

        if (auth()->user()->UserHasRole('Admin')) 
        {
            $replies = CommentReply::paginate(1);
        } 
        else 
        {
            $replies = auth()->user()->authreplies()->paginate(1);
        }

        return view('comments.replies.show', compact('replies'));

    
    
    }

   
    public function edit($id)
    {
        //
    }

    //this update is for approve and unapprove reply
    public function update(Request $request, CommentReply $reply)
    {
        $reply->update($request->all());
        return back();
    }

   
     public function destroy(CommentReply $reply)

    {
        $reply->delete();
        Session::flash('deleting_message','Your Reply had deleted');
         
        return back();
    }
}
