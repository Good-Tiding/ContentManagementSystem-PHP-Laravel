<x-admin-master>
    @section('content')  
      @include('timeout-flasmessage') 
        @if(count($replies)> 0)
            <h1> Replies </h1>
                @if(Session::has('deleting_message'))
                <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>
                @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"> Replies Table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>Reply</th>
                                    <th>Post Link</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    @foreach ($replies as $reply)
                                        @if(!$reply->user->UserHasRole('Admin'))
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
                                    <th>Reply</th>
                                    <th>Post Link</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    @foreach ($replies as $reply)
                                        @if(!$reply->user->UserHasRole('Admin'))
                                            <th>Admin Decision</th>
                                        @endif
                                    @endforeach
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                
                            <tbody>
                                @foreach ($replies as $reply)
                                    <tr>
                                        <td>{{($replies->currentpage()-1) * $replies->perPage() + $loop->index + 1 }}</td>
                                        
                                        {{-- <td> {{$reply->author}} </td> --}}
                                        <td>{{$reply->user->UserHasRole('Admin') ? $reply->user->name . " (The admin comment)" : $reply->user->name }}</td>
                                        <td>{{$reply->email}}</td>
                                        <td>{{$reply->body}}</td>
                                        <td><a href="{{route('blog.post',$reply->comment->post->slug)}}">View Post</a></td>
                                        <td>{{$reply->created_at->diffForHumans()}}</td>
                                        <td>{{$reply->updated_at->diffForHumans()}}</td>

                                @if(auth()->user()->UserHasRole('Admin')) 
                                               
                                    @if(!$reply->user->UserHasRole('Admin'))
                                        <td>
                                            @if($reply->is_active==1)
                                                <form method="post" action="{{ route('replies.update', $reply) }}">
                                                    <input type="hidden" name="_method" value="patch">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="is_active" value="0">
                                                    <button type="submit" class="btn btn-success">Un-Approve</button>
                                                </form>
                                            @else
                                                <form method="post"  action="{{ route('replies.update', $reply) }}" >
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
                                        @if($reply->is_active==1)
                                            <h6>  Your reply has approved</h6>
                                        @else
                                            <h6><strong>Your reply hasn't approved yet</strong></h6>
                                        @endif
                                        
                                    </td>
                                @endif
                                        <td>
                                            <form method="post"  action="{{ route('replies.destroy', $reply) }}">
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
         <h1 class="text-center">No Replies</h1>   
        @endif

        <div class="d-flex">
            <div class="mx-auto">
               {{$replies->links('vendor.pagination.bootstrap-4')}}
             </div>
         </div>

    @endsection
</x-admin-master>