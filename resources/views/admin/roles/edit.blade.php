<x-admin-master>
    @section('content')
     <h1>Editing Roles</h1>
        <div class="row">
           <div class="col-sm-8">
                <form method="post"  action="{{ route('role.update', $role_edit->slug) }}">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="nameee">Role Name</label>
                            <input type="text" id="nameee" name="name" value="{{ $role_edit->name }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autocomplete="off">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update Role</button>
                    </div>
                </form>
                
            </div>
        </div>
        
        {{-- <div class="row">
            <div class="col-sm-12">
               @if ($perm_all ->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Permissions Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>Permission_ID</th>
                                            <th>Name</th>
                                       
                                            <th>Attach</th>
                                            <th>detach</th>  
                                        </tr>
                                    </thead>
        
                                    <tfoot>
                                        <tr>
                                            <th>Options</th>
                                            <th>Permission_ID</th>
                                            <th>Name</th>
                                          
                                            <th>Attach</th>
                                            <th>detach</th>
                                        </tr>
                                    </tfoot>
        
                                    <tbody>
                                        @foreach ($perm_all as $perm)
                                           <tr>
                                               <td>  <input type="checkbox"
                                                        @foreach ($role_edit->permissions as $role_perm)
                                                            @if ($role_perm->slug == $perm->slug)
                                                               checked
                                                            @endif
                                                        @endforeach
                                                    > 
                                                </td>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$perm->name}}</a></td>
                                          
                                                <td>
                                                    <form method="post" action="{{ route('role.perm.attach', $role_edit->slug) }}">
                                                        <input type="hidden" name="_method" value="put">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="permission" value="{{ $perm->id }}">
                                                        <button type="submit" class="btn btn-primary" {{ $role_edit->permissions->contains($perm) ? 'disabled' : '' }}>
                                                            Attach
                                                        </button>
                                                    </form>  
                                                </td>

                                                <td>
                                                    <form method="post"  action="{{ route('role.perm.detach', $role_edit->slug) }}">
                                                        <input type="hidden" name="_method" value="put">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="permission" value="{{ $perm->id }}">
                                                    
                                                        <button type="submit" class="btn btn-danger" {{ !$role_edit->permissions->contains($perm) ? 'disabled' : '' }}>
                                                            Detach
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>    --}}
    @endsection
</x-admin-master>   