<x-admin-master>
    @section('content')
     @include('timeout-flasmessage')
      <h1> Roles</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{ route('role.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                    <div class="form-group">
                        <label for="nameee">Role Name</label>
                        <input type="text" id="nameee" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off">
                
                        @if ($errors->has('name'))
                            <div>
                                <span><strong>{{ $errors->first('name') }}</strong></span>
                            </div>
                        @endif
                    </div>
                
                    <button type="submit" class="btn btn-info">Create Role</button>
                </form>   
            </div>
            <div class="col-sm-9">
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">Roles Table</h6>
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
                                        <th>Role_ID</th>
                                        <th>Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Role_ID</th>
                                        <th>Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    @foreach ($roles_index as $role)
                                      <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="{{route('role.edit',$role->slug)}}">{{$role->name}}</a></td>
                                            <td>
                                                <form method="post" action="{{ route('role.delete', $role->slug) }}">
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
            </div>
        </div>
    @endsection  
</x-admin-master>