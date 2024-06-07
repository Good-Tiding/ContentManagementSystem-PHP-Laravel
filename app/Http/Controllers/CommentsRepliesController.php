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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
      //'photo_id'=> $user->userphoto->id,
           'photo_id'=>  $photoId,
            'body' => $request->body, 
            'is_active' => $isAdmin ? 1 : 0, // Set to active if user is admin
        ]; 
        CommentReply::create($data);
       // return $request->all();
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

          /*  $comment=Comment::findOrFail($id);
     $replies =  $comment->replies;
     return view('comments.replies.show', compact('replies')); 
 */
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReply $reply)
    {
        $reply->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy(CommentReply $reply)

    {
        /* if($reply->photo)
        {
        $path = parse_url($reply->photo->file);
      
        unlink(public_path($path['path']));
        } */

        $reply->delete();
        Session::flash('deleting_message','Your Reply had deleted');
         
        return back();
    }
}
