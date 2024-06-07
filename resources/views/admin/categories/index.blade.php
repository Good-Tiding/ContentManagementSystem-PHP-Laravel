<x-admin-master>
    @section('content')
      @include('timeout-flasmessage')

        <h1> Categories </h1>
        <br>

        <div class="row">
            <div class="col-sm-3">

                <form method="POST" action="{{ route('category.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Categories Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off">
                
                        <div class="error_messages">
                            @error('name')
                            <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <input type="submit" value="Create Category" class="btn btn-info">
                    </div>
                </form>
                
            </div>
        
        <!-- DataTales Example -->
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                @if(Session::has('deleting_message'))
                                 <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>
                                @elseif(Session::has('updating_message'))
                                 <div class='alert alert-success' >{{Session::get('updating_message')}}</div>
                                @endif
                                    <thead>
                                        <tr>
                                            <th>Category_ID</th>
                                            <th>Name</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Category_ID</th>
                                            <th>Name</th>  
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <input type="hidden" name='category_id_database' value={{$category->id}} >
                                                <td><a href="{{route('category.edit',$category->slug)}}">{{$category->name}}</a></td>
                                                
                                                <td>
                                                    <form method="POST" action="{{ route('category.destroy', $category) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    
                                                        <input type="submit" value="Delete" class="btn btn-danger">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach          
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection 
</x-admin-master>