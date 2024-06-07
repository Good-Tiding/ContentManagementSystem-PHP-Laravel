<x-admin-master>
    @section('content')
     <h1>Editing Comment</h1>
        <div class="row">
           <div class="col-sm-8">
                <form method="post"  action="{{ route('comments.update', $comment) }}">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="post_number" value="{{ $postNumber }}">
        
                    <input type="hidden" name="page" value="{{ request('page') }}">
                  
                
                    <div class="form-group">
                        <div class="col-sm-6">
                         
                            <input type="text"  name="body" value="{{ $comment->body }}" class="form-control" autocomplete="off"> 
                          
                        </div>
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update Comment</button>
                    </div>
                </form>
                
            </div>
        </div>
   @endsection
</x-admin-master>       