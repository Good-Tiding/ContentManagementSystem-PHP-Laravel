<x-admin-master>
    @section('content')
      @include('timeout-flasmessage')
     
        @if(Session::has('updating_message'))
            <div class='alert alert-primary' >{{Session::get('updating_message')}}</div>
        @endif
        <h1>User Profile Of {{$user->name}}</h1>
<div class="col-sm-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Roles Assign Table </h6>
        </div>
        <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Options</th>
                            <th>Role_ID</th>
                            <th>Name</th>
                            
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Options</th>
                            <th>Role_ID</th>
                            <th>Name</th>
                            
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach ($show_roles as $role)
                            <tr>
                                <td>
                                    <input type="checkbox"
                                        @foreach ($user->roles as $user_role)
                                            @if($user_role->slug == $role->slug )
                                            checked
                                            @endif
                                        @endforeach
                                    >
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$role->name}}</td>
                                
                                <td>
                                    <form method="post" action="{{ route('user.role.attach', $user->slug) }}">
                                        <input type="hidden" name="_method" value="put">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="role" value="{{ $role->id }}">
                                        <button type="submit" class="btn btn-primary" {{ $user->roles->contains($role) ? 'disabled' : '' }}>
                                            Attach
                                        </button>
                                    </form>    
                                </td>

                                <td>
                                    <form method="post" action="{{ route('user.role.detach', $user->slug) }}">
                                        <input type="hidden" name="_method" value="put">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="role" value="{{ $role->id }}">
                                        <button type="submit" class="btn btn-danger" {{ !$user->roles->contains($role) ? 'disabled' : '' }}>
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
</div> 
@endsection

</x-admin-master>