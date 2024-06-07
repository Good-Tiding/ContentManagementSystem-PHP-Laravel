
@include('timeout-flasmessage')

<div class="card my-4">

  <h5 class="card-header">Search</h5>
  <div class="card-body">
    <div class="input-group">
      {{-- action="{{ route('search') }}" --}}
      <form id="searchForm"  method="GET" autocomplete="off">
        @csrf
        <input id="searchInput" 
          type="text"
          name="query"  
          class="form-control" 
          placeholder="Search for..."
          onkeydown="if(event.keyCode==13) return false;"
          {{-- prevent the enter to be submitted when i am searching --}}
        >
      </form>

      <span class="input-group-btn">
        <button class="btn btn-secondary"  type="button" onclick="submitSearch()">Go!</button>
      </span>
       
       
    </div>
  </div>
</div>


{{-- @if (request()->is('/'))
@if ($query)
    @if ($totalPostsCount > 0)
       
        @if ($hasOriginalResults)
         
            @if ($originalPaginator->count() > 0)
                <div class="alert alert-success">
                    Found {{ $originalPaginator->total() }} unique queries matching '{{ $query }}'.
                </div>
            @else
                <div class="alert alert-info">
                    No unique queries found matching '{{ $query }}'.
                </div>
            @endif
        @else
          
            <div class="alert alert-info">
                No posts found matching '{{ $query }}'.
            </div>
        @endif
    @else
       
        <div class="alert alert-info">
            No posts to search in.
        </div>
    @endif
@endif

@endif --}}


@if (request()->is('/'))
  @if ($query)
    @if ($totalPostsCount > 0)
      @if (!$hasOriginalResults)
        <div class="alert alert-info">
            No result found matching '{{ $query }}' in all paginators.
        </div>
    
      @else
        <h5> Queries total number in all paginators is : {{$originalPaginator->total()}}</h5>
        @if($totalHighlightedCount > 0)
        
          <div class="alert alert-success">
          
            Found {{ $totalHighlightedCount }} unique queries matching '{{ $query }}' in this paginator . 
          </div>
       @else
        <div class="alert alert-info">
          No unique queries found matching '{{ $query }}' in this paginator.
        </div>
      @endif
      @endif
    @else
        {{-- There are no posts at all in the database --}}
        <div class="alert alert-info">
            No posts to search in.
        </div>
    @endif
  @endif

@else

  @if ($query)

    @if (!$hasOriginalResults)
      <div class="alert alert-info">
          No result found matching '{{ $query }}'.
      </div>
    @endif

  @endif
@endif




 {{-- @if ($query)
  {{--  when you check $posts, you're checking if the paginator exists, not if there are any results. Since the paginator always exists, $posts will always be truthy, even if there are no results. --}}
  {{-- @if ($posts->total() > 0)
    @if($totalHighlightedCount > 0)
      <div class="alert alert-success">
        Found {{ $totalHighlightedCount }} unique queries matching '{{ $query }}'. 
      </div>
    @else
      <div class="alert alert-info">
        No unique queries found matching '{{ $query }}'.
      </div>
    @endif
  @else
    <div class="alert alert-info">
      No posts to search in.
    </div>
  @endif
@endif  --}} 


<script>
  //  enable searching when clicking the button
    function submitSearch() {

       
      
        var query = document.getElementById('searchInput').value.trim();
        if (query !== '') 
        {
         
            document.getElementById('searchForm').submit();
        }
    }
</script>

    

