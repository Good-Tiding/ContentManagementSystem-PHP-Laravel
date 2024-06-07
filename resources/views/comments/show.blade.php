<x-admin-master>
    @section('content')  
      @include('timeout-flasmessage') 
        @if(count($comments)> 0)
            <h1> Comments </h1>

            @if(Session::has('deleting_message'))
              <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>
            @elseif(Session::has('updating_message'))
              <div class='alert alert-success' >{{Session::get('updating_message')}}</div>
              
              
            @endif

            <div class="card shadow mb-4">
               <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>

                <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    @foreach ($comments as $comment)
                                    @if(!$comment->user->UserHasRole('Admin'))
                                    <th>Show Comment</th>
                                    @else
                                    <th>Edit Comment</th>
                                    @endif
                              
                                    
                                @endforeach
                                    <th>Post Link</th>
                                    <th>Replies Link</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    
                                        
                                    @foreach ($comments as $comment)
                                    @if(!$comment->user->UserHasRole('Admin'))
                                    <th>Admin Decision</th>
                                    @endif
                                @endforeach
                                     
                                    
                                    <th>Delete</th>
                                
                                </tr>
                            </thead>
    
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    @foreach ($comments as $comment)
                                        @if(!$comment->user->UserHasRole('Admin'))
                                        <th>Show Comment</th>
                                        @else
                                        <th>Edit Comment</th>
                                        @endif
                                  
                                        
                                    @endforeach
                                    <th>Post Link</th>
                                    <th>Replies Link</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                   
                                       
                                    @foreach ($comments as $comment)
                                    @if(!$comment->user->UserHasRole('Admin'))
                                    <th>Admin Decision</th>
                                    @endif
                                @endforeach
                                       
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{($comments->currentpage()-1) * $comments->perPage() + $loop->index + 1 }}</td>
                                        <td> {{$comment->user->UserHasRole('Admin') ? $comment->user->name . " (The admin comment)" : $comment->user->name }} </td>
                                        <td>{{$comment->email}}</td>
                                        @if(auth()->user()->UserHasRole('Admin')) 
                                          
                                            <td>
                                                @if(!$comment->user->UserHasRole('Admin'))
                                                 {{$comment->body}}
                                                @else
                                                    <a href="{{ route('comments.edit', ['comment' => $comment, 'post_number' => ($comments->currentpage()-1) * $comments->perPage() + $loop->index + 1, 'page' => $comments->currentPage()]) }}">
                                                        {{$comment->body}}
                                                    </a>
                                                @endif
                                            </td>
                                       

                                        @else
                                        <td>
                                            <a href="{{ route('comments.edit', ['comment' => $comment, 'post_number' => ($comments->currentpage()-1) * $comments->perPage() + $loop->index + 1, 'page' => $comments->currentPage()]) }}">
                                                {{$comment->body}}
                                            </a>
                                        </td>
                                        @endif
                                        {{-- <td>
                                            @if(!$comment->user->UserHasRole('Admin') )
                                        <a href="{{ route('comments.edit', ['comment' => $comment, 'post_number' => ($comments->currentpage()-1) * $comments->perPage() + $loop->index + 1, 'page' => $comments->currentPage()]) }}">
                                            {{$comment->body}}
                                        </a>
                                        @endif
                                        </td> --}}
                                        {{-- <td><a href="{{route('comments.edit',$comment)}}">{{$comment->body}}</a></td> --}}
                                        <td><a href="{{route('blog.post',$comment->post->slug)}}">View Post</a></td>
                                        <td><a href="{{route('replies.show',$comment->id)}}">View Replies</a></td>
                                        <td>{{$comment->created_at->diffForHumans()}}</td>
                                        <td>{{$comment->updated_at->diffForHumans()}}</td>
                                @if(auth()->user()->UserHasRole('Admin')) 
                                               
                                    @if(!$comment->user->UserHasRole('Admin'))
                                        <td>
                                            @if($comment->is_active==1)
                                                <form method="post" action="{{ route('comments.approve.unapprove', $comment) }}">
                                                    <input type="hidden" name="_method" value="patch">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="is_active" value="0">
                                                    <button type="submit" class="btn btn-success">Un-Approve</button>
                                                </form>
                                            @else
                                                <form method="post" action="{{ route('comments.approve.unapprove', $comment) }}">
                                                    <input type="hidden" name="_method" value="patch">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="is_active" value="1">
                                                    <button type="submit" class="btn btn-info">Approve</button>
                                                </form> 
                                            @endif
                                        </td>

                                    @endif
                                              
                                @else
                                               <td>
                                                            @if($comment->is_active==1)
                                                             <h6>  Your comment has approved</h6>
                                                            @else
                                                             <h6><strong>Your comment hasn't approved yet</strong></h6>
                                                            @endif
                                                   
                                                </td>
                                @endif
                                           
                    
                                        <td>
                                            <form method="post" action="{{ route('comments.destroy', $comment) }}">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        @else
         <h1 class="text-center">No Comments</h1>   
        @endif

        <div class="d-flex">
            <div class="mx-auto">
               {{$comments->links('vendor.pagination.bootstrap-4')}}
             </div>
         </div>

    @endsection
</x-admin-master>