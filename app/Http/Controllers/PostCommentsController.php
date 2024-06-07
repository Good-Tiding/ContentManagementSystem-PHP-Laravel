<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostCommentsController extends Controller
{
    public function store(Request $request)
    {

        $user=Auth::user();
        $isAdmin=auth()->user()->UserHasRole('Admin');
        $photoId = $user->userphoto ? $user->userphoto->id : 'https://placehold.co/600x400';
        $data=[
            'post_id' => $request->post_id,
            'user_id' => $user->id,
            'author' => $user->name,
            'email' => $user->email,
            'photo_id'=>  $photoId,
            'body' => $request->body, 
            'is_active' => $isAdmin ? 1 : 0, 
        ]; 
        Comment::create($data);

        if($isAdmin)
        {
                 session()->flash('comment_message','Your comment has posted, you are the admin!!');
        }
       else
       {
        session()->flash('comment_message','Your comment has been submitted and it is waiting for moderation');

       }
       return redirect()->back();  
    }

    public function show(Post $post)
    {
     if (auth()->user()->UserHasRole('Admin')) 
     {
         $comments = Comment::paginate(1);
     } 
     else 
     {
         $comments = auth()->user()->authcomments()->paginate(1);
     }

     return view('comments.show', compact('comments'));
    }
    
    public function edit( Comment $comment)
    {
        $postNumber = request()->query('post_number');
         $page =  request()->query('page');
       
        return view('comments.edit', compact('comment','page','postNumber'));
    }

   
    public function update(Request $request, Comment $comment)
    {
        $postNumber = $request->input('post_number');
        $page = $request->input('page');

        if($comment->body != $request->body)
        {
            $comment->body = $request->body;
            $comment->save();
            
           
          
            Session::flash('updating_message','Your comment '.$postNumber .' has been updated');
        }
        else
        {
            Session::flash('updating_message','Nothing has changed' );
        }

     // $comment->update($request->all());

        return redirect()->route('comments.show',[$comment,'page' => $page]);
    }
 

    public function ApproveUnApprove (Request $request, Comment $comment)
    {
        $comment->update($request->all());
        return back();
    }
        
        
    public function destroy(Comment $comment)
    {
        
      
        $comment->delete();
        Session::flash('deleting_message','Your Comment had deleted');
         
        return back();
    }
}
