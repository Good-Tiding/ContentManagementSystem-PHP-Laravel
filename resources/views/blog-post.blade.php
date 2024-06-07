<x-home-master >
  @section('content')
   @include('timeout-flasmessage')

    <h1 class="media">
    {{--   {!! preg_replace
        ('/\b'.$query.'\b/i', '<span style="background-color: yellow;">$0</span>',
         $post->title) !!} --}}
         {!! preg_replace('/('.preg_quote($query).')/i', 
         '<span style="background-color: yellow" class="highlight22">$0</span>', $post->title) !!}
    </h1>

    <p class="lead">by {{$post->user->name}} </p>
    <hr>

    <p>Posted on {{$post->created_at->diffForHumans()}}</p>
    <hr>

    <img height="200px" width="300px" src="{{ $post->post_image ? $post->post_image: 'https://placehold.co/600x400'}}">
    <hr>

@php
  $postContent = strip_tags($post->body);// Strip HTML tags including <p> tags
  $highlightedContent = preg_replace('/('.preg_quote($query).')/i', 
    '<span style="background-color: yellow" class="highlight22">$0</span>', $postContent);
@endphp
{!! $highlightedContent !!}
    <hr>

  
    @if(Auth::check())
      @if (session('comment_message'))
       <div class='alert alert-success'>{{session('comment_message')}}</div>
      @endif
    
           
             
      <div class='comment'>
        <h3 class="card-header">Leave a Comment</h3>
        <form method="post" action="{{ route('comments.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="post_id" value="{{ $post->id }}">
      
          <div class="form-group">
            <textarea name="body" class="form-control" rows="3"></textarea>
          </div>
         

          <div class="form-group">
            
              <button type="submit" class="btn btn-primary">Publish</button> 
          
          </div>
          <br>
        </form>
       
      </div> 

      @if (session('reply_message'))                 
        <div class='alert alert-success'>{{session('reply_message')}}</div>
      @endif

      @if(count($comments) >0) 
        @foreach ($comments as $comment )
          <div class="media">
            <a class="pull-left" href="#">
              {{-- class="media-object" --}}
              <img  height="64" class="media-object  d-flex mr-3 rounded-circle" src="{{$comment->photo ? $comment->photo->file: 'https://placehold.co/600x400'}}"> 
            </a>
            <div class="media-body">                                
              <h6 class="media-heading">{{$comment->author}}
               <small>{{$comment->created_at->diffForHumans()}}</small>
              </h6>
              <p>{{$comment->body}}</p>
              <div class="comment-reply-container">
                <button class= "toggle-reply btn btn-primary float-end">Reply</button>
                <div class="comment-reply">
                  <form method="post" action="{{ route('replies.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
              
                    <br>

                    <div class="form-group">
                        <label for="replies">YOUR REPLY: </label>
                        <textarea id="replies" name="body" class="form-control" rows="2"></textarea>
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Post your reply</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Nested Comment -->
              @if(count($comment->replies) >0) 
                @foreach ($comment->replies as $reply )
                  @if($reply->is_active==1) 
                    <div class="media">
                      <a class="pull-left" href="#">
                        {{-- ازا حطيناclass="media-object لحاله رح يعطيني صورة مربعة --}}
                        <img height="64" class="media-object d-flex mr-3 rounded-circle" src="{{$comment->photo ? $comment->photo->file: 'https://placehold.co/600x400'}}">
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

  @section('scripts-blog')

    <script>
      $(".comment-reply-container .toggle-reply").click(function(){
      //console.log('bjkkkk');
      $(this).next().slideToggle("slow");
      });
    </script>

    <script>
      // Check if the query parameter exists in the URL
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('query')) {
          // Remove the query parameter from the URL
          urlParams.delete('query');
          
          // Replace the current URL without the query parameter
          const newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
          history.replaceState(null, '', newUrl);
      }
    </script>

  @endsection
</x-home-master>