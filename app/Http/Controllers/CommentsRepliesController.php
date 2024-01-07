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
        //
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

        $data=[
            'comment_id' => $request->comment_id,
             'author' => $user->name,
            'email' => $user->email,
            'photo_id'=> $user->photo->file,
            'body' => $request->body, 
        ]; 
        CommentReply::create($data);
       // return $request->all();

       session()->flash('reply_message','Your reply has been submitted and it is waiting for moderation');
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $comment=Comment::findOrFail($id);
     $replies =  $comment->replies;
     return view('comments.replies.show', compact('replies')); 

    
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
        $reply->delete();
        Session::flash('deleting_message','Reply '.$reply->id.' had deleted');
         
        return back();
    }
}
