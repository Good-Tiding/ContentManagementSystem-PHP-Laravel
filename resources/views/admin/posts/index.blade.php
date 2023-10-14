<x-admin-master>
    @section('content')
    
           <h1>View Posts</h1>

           @if(Session::has('deleting_message'))
           <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>

           @elseif (session('creating_message'))
           <div class='alert alert-success' >{{session('creating_message')}}</div>

           @elseif (session('updating_message'))
           <div class='alert alert-primary' >{{session('updating_message')}}</div>

           @endif

          <!-- DataTales Example -->
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
                            <th>Image</th>
                            <th>Owner</th>
                            <th>Categeory</th>
                            <th>Title</th>
                            
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Owner</th>
                            <th>Categeory</th>
                            <th>Title</th>
                           
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @if($show_posts)

                    @foreach ($show_posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td> <img height="60px" src="{{$post->post_image }}"> </td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->category ? $post->category->name :'UnCategorized'}}</td>
                            <td ><a href="{{route('post.edit',$post->id)}}">{{$post->title}}</a></td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                            <td>
                                @can('view',$post)
                                {!! Form::open(array('method' => 'delete', 'route' =>array('post.delete', $post->id )))!!}
                              
                                {!! Form::submit ('Delete',['class'=>'btn btn-danger'])!!}
                            
                                {!! Form::close() !!}
                                @endcan

                            </td>
                            
                        </tr>
                     @endforeach
                     @endif

                    </tbody>

                    </table>
                </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {{$show_posts->links()}}
                </div>
            </div>

    @endsection
   

    @section('table scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        {{-- <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>  --}}

    @endsection



   {{--  @foreach ($show_posts as $post)
    <div class="title">
       TITLE: {{$post->title}};
    </div>

    <div class="body">
       BODY: {{$post->body}};
    </div>
        
    @endforeach --}}
    
    
</x-admin-master>
