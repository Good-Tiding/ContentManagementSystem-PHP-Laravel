<x-admin-master>
    @section('content')
   
      <h1>Show Posts Related to a {{$category->name}} Category</h1>
        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Post_title</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                </tr>
                            </thead>
                
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Post_title</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                </tr>
                            </tfoot>
            
                            <tbody>
                                @foreach ($category->posts as $post) 
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{route('blog.post',$post->slug)}}">{{$post->title}}</a></td>
                                        <td>{{$post->created_at->diffForHumans()}}</td>
                                        <td>{{$post->updated_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    @endsection
</x-admin-master>   