<x-admin-master>
    @section('content')
      @include('timeout-flasmessage')
       <h1>Users</h1>

        @if(Session::has('deleting_message'))
         <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>
        @endif
     
       <div class="card shadow mb-4">
           <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Users Table </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                            <tr>
                                <th>Id</th>
                           {{--      <th>UserName</th> --}}
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Delete</th>
                            
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>Id</th>
                                {{-- <th>UserName</th> --}}
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>

                        <tbody>
                            @if($show_users)
                                @foreach ($show_users as $user)
                                    <tr>
                                       
                                        <td>{{($show_users->currentpage()-1) * $show_users->perPage() + $loop->index + 1 }}</td>
                                        <td>
                                        @if(! $user->UserHasRole('Admin'))
                                          <a href="{{route('user.profile.role.attach',$user->slug)}}">{{$user->name}}</a>
                                        @else 
                                         {{$user->name}}
                                         @endif
                                           {{--  <a href="{{route('user.profile.role.attach',$user->slug)}}">{{$user->name}}</a> --}}
                                        </td>
                                        {{--< td>{{$user->name}}</td> --}}
                                        <td>
                                            <img height="60px" src="{{$user->userphoto ? $user->userphoto->file  : 'https://placehold.co/600x400' }}" >
                                        </td>

                                        <td>
                                            @foreach ($user->roles as $user_role)
                                             <br> {{$user_role->name }} <br/>
                                            @endforeach
                                        </td>
                                        <td>{{$user->email}}</td>
                                
                                        <td>
                                            <form method="post"  action="{{ route('delete.user', $user->slug) }}">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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
              {{$show_users->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    @endsection

    @section('table scripts')

    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script>  --}}
    @endsection

</x-admin-master>