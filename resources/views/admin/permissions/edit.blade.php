{{-- <x-admin-master>
    @section('content')   
      <h1>Editing Permissions</h1>
        <div class="row">
            <div class="col-sm-8">
                <form method="post" action="{{ route('perm.update',$perm_edit->slug) }}" autocomplete="off" >
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="nameee">Permission Name</label>
                            <input type="text" id="nameee" name="name" value="{{ $perm_edit->name }}" class="form-control">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update Permission</button>
                    </div>
                </form>
                
            </div>
        </div> 
        
        
        <div class="row">
            <div class="col-sm-12">
               @if ($user_all ->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Users Assign Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>User_ID</th>
                                            <th>Name</th>
                                       
                                            <th>Attach</th>
                                            <th>detach</th>  
                                        </tr>
                                    </thead>
        
                                    <tfoot>
                                        <tr>
                                            <th>Options</th>
                                            <th>User_ID</th>
                                            <th>Name</th>
                                          
                                            <th>Attach</th>
                                            <th>detach</th>
                                        </tr>
                                    </tfoot>
        
                                    <tbody>
                                        @foreach ($user_all as $user)
                                           <tr>
                                               <td>   <input type="checkbox"
                                                        @foreach ($perm_edit->users as $perm_user)
                                                            @if ($perm_user->slug == $user->slug)
                                                               checked
                                                            @endif
                                                        @endforeach
                                                        > 
                                                    
                                                </td>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->name}}</a></td>
                                          
                                                <td>
                                                    <form method="post" action="{{ route('perm.user.attach', $perm_edit->slug) }}">
                                                        <input type="hidden" name="_method" value="put">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-primary" {{ $perm_edit->users->contains($user) ? 'disabled' : '' }}>
                                                            Attach
                                                        </button>
                                                    </form>  
                                                </td>

                                                <td>
                                                    <form method="post" action="{{ route('perm.user.detach', $perm_edit->slug) }}">
                                                        <input type="hidden" name="_method" value="put">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-danger" {{ !$perm_edit->users->contains($user) ? 'disabled' : '' }}>
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
        </div> 


     
    @endsection
</x-admin-master>    --}}