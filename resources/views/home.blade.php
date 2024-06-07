<x-home-master>
 {{--  <x-home.sidebar.home-sidebar-search></x-home.sidebar.home-sidebar-search> --}}
   

  @section('content')
    @if(count($posts)>0)
      <!-- Blog Post -->
      @foreach ($posts as $post )
       <div class="card mb-4">
          {{-- <img class="card-img-top" src="{{ $post->post_image }}" alt="Card image cap"> --}}
          <img src="{{ $post->post_image }}">
          <div class="card-body">
            <h2 class="card-title">
            {{-- هي بتلاقي كلمة كاملة --}}
            {{-- {!! preg_replace('/\b('.preg_quote($query).')\b/i', 
            '<span style="background-color: yellow">$0</span>', $post->title) !!} --}}

            <h2>
            {{-- هي بتلاقي الكلمة كلملة واجزاء من الكلمة --}}
             {!! preg_replace('/('.preg_quote($query).')/i', 
            '<span style="background-color: yellow" class="highlight22">$0</span>', $post->title) !!}
            </h2>  
           
           {{--  <p class="card-text">{{ Str::limit(strip_tags(html_entity_decode($post->body)), 20, '....') }}</p> --}}

            @if(Auth::check())
             <a href="{{route('blog.post',$post->slug)}}" class="btn btn-primary">Read More &rarr;</a>
            @else
             <a href="{{url('/login')}}" class="btn btn-primary">Read More &rarr;</a>
            @endif

          </div>
          <div class="card-footer text-muted">
            Posted on {{$post->created_at->diffForHumans()}}
          </div>
       </div>
        <!-- Display the pagination links -->
        <div class="d-flex">
          <div class="mx-auto">
            {{--  {{$posts->links()}} --}}
            {{--  This will ensure that the query parameter is included in the pagination links, so when you click on a page number, the query parameter will be retained. --}}
             {{ $posts->appends(['query' => $query])->links('vendor.pagination.bootstrap-4') }}

        
          </div>
        </div>
      @endforeach

    @else
    <div style="text-align: center; padding-top: 150px;">
      <h2> There is no posts yet <a href="{{url('/login')}}"> login </a> 
        to create a post if you have an account 
        or 
        <a href="{{url('/register')}}">register</a> 
      </h2>
    </div> 

    @endif
  @endsection

  @section('scripts-blog')
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
