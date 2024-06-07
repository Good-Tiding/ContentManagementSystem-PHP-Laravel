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

  public function index(Request $request)
    {
      if (auth()->user()->UserHasRole('Admin'))
      {
        $show_posts = Post::paginate(1);
      }
      else
      {
      $show_posts = auth()->user()->posts()->paginate(1);
      }
          return view('admin.posts.index',compact('show_posts'));
    }


    public function show(Post $post,Request $request)
    {
      $comments=$post->comments()->whereIsActive(1)->get();

        return view('blog-post',compact('post','comments'));
 
    }

  
    public function create(Post $post)
    {
        $categories=Category::pluck('name','id')->all();
        
        return view('admin.posts.create',compact('categories','post'));
    }

    public function store(Post $post)
    {  

      $this->authorize('create',$post);
      $inputs=request()->validate
      ([
      'title'=>'required|min:2|max:255',
      //'category_id'=>'required',
      'post_image' =>'file',
      'body'=>'required'
      ]);

      if (request('category_id')) {
        $inputs['category_id'] = request('category_id');
    }

 
     if(request('post_image'))
      {
          $inputs['post_image']=request('post_image')->store('images');
      } 
       auth()->user()->posts()->create($inputs);

        // Get the paginator instance from your query
    $paginator = auth()->user()->posts()->paginate(1);

    // Get the last page number from the paginator
    $lastPage = $paginator->lastPage();  
    
       
       //return back(); 
      session()->flash('creating_message','Post with title '.$inputs['title'].' has created');
       return redirect()->route('post.index',['page' => $lastPage]);
       
    }


    

    

    public function edit(Post $post,Request $request)
    {
        //if(auth()->user()->can('view',$post))
    
        $postNumber = request()->query('post_number');
       // $page = $request->input('page');
        $page =  request()->query('page');
        $this->authorize('view',$post);
        //dd($post) ;  

        $categories=Category::pluck('name','id')->all();
      

        return view('admin.posts.edit',['post'=>$post,
                                        'categories'=>$categories,
                                        'postNumber'=>$postNumber,
                                        'page'=>$page,
                    ]);
        
        
    }

    public function update(Post $post,Request $request)
    {
    $postNumber = $request->input('post_number');
    $page = $request->input('page');
    //dd($postNumber);
    
      $inputs=request()->validate
        ([
        'title'=>'required|min:2|max:255',
        'post_image' =>'file',
        'body'=>'required',
        //'category_id'=>'required'
        
        ]);

      

        if (request('category_id') && request('category_id') != $post->category_id) {
          $post->category_id = request('category_id');
        }

         if($request->hasFile('post_image'))
        {
           
        if ($post->post_image && $post->post_image != 'https://placehold.co/600x400')
          {
            $path = parse_url($post->post_image, PHP_URL_PATH);
            $filePath = public_path($path);
            if (is_file($filePath)) 
            {
             unlink($filePath);
            }
          }
          $inputs['post_image']=request('post_image')->store('images');
          $post->post_image = $inputs['post_image']; 
        }
 
    if ($post->post_image === 'https://placehold.co/600x400') 
      {
      // If no new image is uploaded and the post image is a placeholder, set it to null
      $post->post_image = null;

     } 
  
   

      $post->title = $inputs['title'];
      $post->body = $inputs['body'];


     $this->authorize('update',$post);

     if($post->isDirty())
     { 
      Session::flash('updating_message', 'Post ' .  $postNumber . ' has been updated');
      $post->save();
     }

     else
     {
      Session::flash('updating_message','Nothing has changed');
     }

    return redirect()->route('post.index',['page' => $page]);
    }
  
    public function delete(Post $post,Request $request)
    {
       // First, authorize the action before performing any deletions
     $this->authorize('delete', $post);  
       
        $path = parse_url($post->post_image, PHP_URL_PATH);
        $filePath = public_path($path);
        if (is_file($filePath)) {
            unlink($filePath);
        }
      
     
    $page = $request->page;
 
    $postNumber = $request->input('row_number');
       // posts()هي رح تمسح كل البوستات المتعلقى باليوزر يلي فاتح لاني عاطيتا الكيوري كله
      //auth()->user()->posts()->delete($post); 
      $post->delete();
    Session::flash('deleting_message', 'Post ' .  $postNumber . ' has been deleted');
     
       return redirect()->route('post.index',['page'=> $page]);
        
    }
  
    public function deletepostimage(Post $post )
    {
        
       
      if ($post->post_image && $post->post_image !== 'https://placehold.co/600x400') 
      {  
        $path = parse_url($post->post_image, PHP_URL_PATH);
        $filePath = public_path($path);
        if (is_file($filePath)) {
            unlink($filePath);
        }
      
        $post->post_image = 'https://placehold.co/600x400'; // or null  
  
        $post->save();
      } 
    }

}