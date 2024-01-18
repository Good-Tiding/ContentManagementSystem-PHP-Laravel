<x-admin-master>

@section('content')   
  @if(count($comments)> 0)


    <h1> Comments </h1>
  

     <!-- DataTales Example -->
     @if(Session::has('deleting_message'))
      <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>
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
                    <th>Comment</th>
                    <th>Post Link</th>
                    <th>Replies Link</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Admin Decision</th>
                    <th>Delete</th>
                   
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Post Link</th>
                    <th>Replies Link</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Admin Decision</th>
                    <th>Delete</th>
                </tr>
            </tfoot>

            <tbody>
           

            @foreach ($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td> {{$comment->author}} </td>
                    <td>{{$comment->email}}</td>
                    <td>{{Str::limit($comment->body,10)}}</td>
                    <td><a href="{{route('blog.post',$comment->post->slug)}}">View Post</a></td>
                    <td><a href="{{route('replies.show',$comment->id)}}">View Replies</a></td>
                 

                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>{{$comment->updated_at->diffForHumans()}}</td>

                    
                    <td>
                       @if($comment->is_active==1)
                            {!! Form::open(array('method' => 'patch', 'route' =>array('comments.update', $comment )))!!}
                                <input type='hidden' name='is_active' value='0'>
                            {!! Form::submit ('Un-Approve',['class'=>'btn btn-success'])!!}
                        
                            {!! Form::close() !!}

                    
                        @else
                        {!! Form::open(array('method' => 'patch', 'route' =>array('comments.update', $comment )))!!}
                             <input type='hidden' name='is_active' value='1'>
                        {!! Form::submit ('Approve',['class'=>'btn btn-info'])!!}
                    
                        {!! Form::close() !!}
                        @endif
                    </td>

                    <td>
                        {!! Form::open(array('method' => 'delete', 'route' =>array('comments.destroy', $comment )))!!}
                              
                        {!! Form::submit ('Delete',['class'=>'btn btn-danger'])!!}
                    
                        {!! Form::close() !!}

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

@endsection


</x-admin-master>