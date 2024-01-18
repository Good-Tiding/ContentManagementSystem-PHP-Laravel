<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function show(Post $post,Comment $comment)
    {
        $comments=$post->comments()->whereIsActive(1)->get();
       // $replies=$comment->replies()->whereIsActive(1)->get();
        return view('blog-post',['post'=>$post,
                                 'comments'=> $comments,
                                // 'replies' => $replies,
    ]);
    }

    public function create()
    {
        $categories=Category::pluck('name','id')->all();
        
        return view('admin.posts.create',compact('categories'));
    }

    public function store(Post $post)
    {  // auth()->user();
       // Auth::user();
      //dd(request()->all());


      $this->authorize('create',$post);
      $inputs=request()->validate
      ([
      'title'=>'required|min:2|max:255',
      //'category_id'=>'required',
      'post_image' =>'file',
      'body'=>'required'
      ]);
 
     if(request('post_image'))
      {
          $inputs['post_image']=request('post_image')->store('images');
      } 
       auth()->user()->posts()->create($inputs);
       
       //return back(); 
      session()->flash('creating_message','Post with title '.$inputs['title'].' has created');
       return redirect()->route('post.index');
       
    }


    public function index()
    {//show posts for all users
        //$show_posts=Post::all();
    //show posts for the logged user only
        $show_posts=auth()->user()->posts()->cursorPaginate(4)->withQueryString();
        //dd($show_posts);
        return view('admin.posts.index',compact('show_posts'));
    }

    public function delete(Post $post)
    {
        
      $path = parse_url($post->post_image);
    // File::delete(public_path($path['path']));
       unlink(public_path($path['path']));
        $this->authorize('delete',$post);
      auth()->user()->posts()->delete($post); 
      // $post->delete();
       Session::flash('deleting_message','Post '.$post->id.' had deleted');
       return redirect()->route('post.index');
        
    }

    public function edit(Post $post)
    {
        //if(auth()->user()->can('view',$post))
        
        $this->authorize('view',$post);
        //dd($post) ;  

        $categories=Category::pluck('name','id')->all();
        
      

        return view('admin.posts.edit',['post'=>$post,
                                        'categories'=>$categories 
                    ]);
        
        
    }

    public function update(Post $post)
    {
        //dd($post) ;  
      $inputs=request()->validate
        ([
        'title'=>'required|min:2|max:255',
        'post_image' =>'file',
        'body'=>'required',
        //'category_id'=>'required'
        
        ]);

        if(request('post_image'))
      {
          $inputs['post_image']=request('post_image')->store('images');
          $post->post_image = $inputs['post_image'];
      } 
      // $post->title متل بعد ما تملي الليبل رح اخده
      $post->title = $inputs['title'];
      $post->body = $inputs['body'];
    //  $post->category_id = $inputs['category_id'];
      //$post->category_id=$inputs['category_id'];
     //auth()->user()->posts()->save($post);
      $this->authorize('update',$post);

     // $post->update($inputs);
     
      $post->save();
      
     Session::flash('updating_message','Post '.$post->id.' has updated');
     return redirect()->route('post.index');
     
        
    }
  
  


}