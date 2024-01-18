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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     $comments = Comment::all();
     return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'post_id' => $request->post_id,
             'author' => $user->name,
            'email' => $user->email,
            'photo_id'=>$user->photo->file,
            'body' => $request->body, 
        ]; 
        
       // return $request->all();

       /*  if($user->photo)
        {
            

            $user->photo_id = $data['photo_id'];
        
        } 
 */
        Comment::create($data);

       
       session()->flash('comment_message','Your comment has been submitted and it is waiting for moderation');
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
     $post=Post::findOrFail($id);
     $comments =  $post->comments;
     return view('comments.show', compact('comments'));
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
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->photo)
        {
        $path = parse_url($comment->photo->file);
      
        unlink(public_path($path['path']));
        }
        
        $comment->delete();
        Session::flash('deleting_message','Comment '.$comment->id.' had deleted');
         
        return back();
    }
}
