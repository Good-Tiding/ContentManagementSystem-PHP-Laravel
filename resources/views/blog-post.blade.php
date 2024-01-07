<x-home-master>

  {{-- the page that when I press load more it takes me to it --}}
  {{-- it's route /post/{post} ,name('blog.post') --}}
  
  @section('content')
  
  
      <h1 class="media">{{$post->title}}</h1>
  
      <!-- Author -->
       <p class="lead">by <a href="#">{{$post->user->name}}</a> </p>
  
      <hr>
  
      <!-- Date/Time -->
        <p>Posted on {{$post->created_at->diffForHumans()}}</p>
  
      <hr>
  
      <!-- Preview Image -->
     
        <img height="150px" width="516px" src="{{ $post->post_image ? $post->post_image:null}}">
    
  
      <hr>
  
      <!-- Post Content -->
         <p>{!! $post->body !!} </p>
      
      
      <hr>
  
      <!-- Comments Form -->
     

@if(Auth::check())

        @if (session('comment_message'))

         <div class='alert alert-success'>{{session('comment_message')}}</div>

        @endif
      
      <div class='comment'>
      {{-- <div class="card my-2"> --}}
        <h5 class="card-header">Leave a Comment</h5>
       
  
        {!! Form::open(array('method' => 'post', 'route' => 'comments.store'))!!}
  

         <input type='hidden' name='post_id'  value={{$post->id}}> 

              <div class="form-group">
  
                  {{-- {!! Form::label ('body','Comment')!!} --}}
                  {!! Form::textarea ('body',null,['class'=>'form-control','rows'=>3])!!}
              </div>
            <br>                
  
                <div class="form-group">
                 {!! Form::submit ('Publish',['class'=>'btn btn-info'])!!}
                </div>  
            <br>
          {!! Form::close() !!}
      
      </div> <!-- close Comment div -->

      <!-- Single Comment -->
          @if (session('reply_message'))
                              
            <div class='alert alert-success'>{{session('reply_message')}}</div>

          @endif
  @if(count($comments) >0) 
    @foreach ($comments as $comment )
  
  
      <div class="media">
            <a class="pull-left" href="#">
              <img height="64" class="media-object" src="{{$comment->photo_id}}" alt="">
            </a>
       <div class="media-body">
              <h6 class="mt-0">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
              </h6>
              <p>{{$comment->body}}</p>
  
             

  
                <div class="comment-reply-container">
                    <button class= "toggle-reply btn btn-primary float-end">Reply</button>


                  <div class="comment-reply ">
                    {!! Form::open(array('method' => 'post', 'route' => 'replies.store'))!!}

                        <input type='hidden' name='comment_id'  value={{$comment->id}}> 

                        <br>
                      <div class="form-group">
                    
                        {!! Form::label ('replies','YOUR REPLY: ')!!}
                        {!! Form::textarea ('body',null,['class'=>'form-control','rows'=>2] ) !!}
                  
                      </div>

                        <br>     
                      <div class="form-group">
              
                        {!! Form::submit ('post your reply ',['class'=>'btn btn-primary'])!!}
              
                      </div>
                      
                    {!! Form::close() !!} 

              

            
                  </div>
                </div>

                   
          
           <!-- Nested Comment -->

            @if(count($comment->replies) >0) 
              @foreach ($comment->replies as $reply )
                @if($reply->is_active==1) 


                 <div class="media">
                     <a class="pull-left" href="#">
                       <img height="64" class="media-object" src="{{$reply->photo_id}}" alt="">
                      </a>
                    <div class="media-body">
                       <h4 class="media-heading">{{$reply->author}}
                       <small>{{$reply->created_at->diffForHumans()}}</small>
                       </h4>
                       <p> {{$reply->body}} </p>
                    </div>
                  </div>
         

                @endif 
              @endforeach
            @endif



         
        </div>
      </div>
  
 

   
     
    @endforeach
  @endif
   
           
@endif
@endsection  
  
        <!-- End Nested Comment -->

         {{--  <div class="media mt-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div> --}}
      <!-- Comment with nested comments -->
      

  
@section('scripts-blog')

  <script>

    $('.comment-reply-container .toggle-reply').click(function(){

   
      $(this).next().slideToggle("slow");
    });
  </script>

@endsection

  
</x-home-master>