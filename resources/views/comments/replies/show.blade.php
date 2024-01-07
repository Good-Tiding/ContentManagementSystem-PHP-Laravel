<x-admin-master>

    @section('content')   
      @if(count($replies)> 0)
    
    
        <h1> Replies </h1>
      
    
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
                        <th>Reply</th>
                        <th>Comment Link</th>
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
                        <th>Reply</th>
                        <th>Comment Link</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Admin Decision</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
    
                <tbody>
               
    
                @foreach ($replies as $reply)
                    <tr>
                        <td>{{$reply->id}}</td>
                        <td> {{$reply->author}} </td>
                        <td>{{$reply->email}}</td>
                        <td>{{$reply->body}}</td>

                        <td><a href="{{route('blog.post',$reply->comment->post->id)}}">View Post</a></td>
                       
                     
    
                        <td>{{$reply->created_at->diffForHumans()}}</td>
                        <td>{{$reply->updated_at->diffForHumans()}}</td>
    
                        
                        <td>
                           @if($reply->is_active==1)
                                {!! Form::open(array('method' => 'patch', 'route' =>array('replies.update', $reply )))!!}
                                    <input type='hidden' name='is_active' value='0'>
                                {!! Form::submit ('Un-Approve',['class'=>'btn btn-success'])!!}
                            
                                {!! Form::close() !!}
    
                        
                            @else
                            {!! Form::open(array('method' => 'patch', 'route' =>array('replies.update', $reply )))!!}
                                 <input type='hidden' name='is_active' value='1'>
                            {!! Form::submit ('Approve',['class'=>'btn btn-info'])!!}
                        
                            {!! Form::close() !!}
                            @endif
                        </td>
    
                        <td>
                            {!! Form::open(array('method' => 'delete', 'route' =>array('replies.destroy', $reply )))!!}
                                  
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
         <h1 class="text-center">No Replies</h1>   
       @endif
    
    @endsection
    
    
    </x-admin-master>