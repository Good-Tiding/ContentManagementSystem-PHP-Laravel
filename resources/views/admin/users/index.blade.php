<x-admin-master>

    @section('content')
    
     <h1>Users</h1>
    
     @if(Session::has('deleting_message'))
     <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>
     @endif
      <!-- DataTales Example -->
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
                    <th>UserName</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Email</th>
                   
                    <th>Delete</th>
                   
                </tr>
            </thead>

            <tfoot>
                <tr>
                    
                    <th>Id</th>
                    <th>UserName</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Email</th>
                  
                    <th>Delete</th>
                </tr>
            </tfoot>

            <tbody>

            @foreach ($show_users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('profile.adminuser',$user->id)}}">{{$user->username}}</a></td>
                    <td>{{$user->name}}</td>

                   
                   
                    <td>
                       <img height="60px" src="{{$user->avatar }}"> 
                    </td>

                    <td>
                        {{-- {{$user->photo->file }} --}}
                        <img height="60px" src="{{$user->photo ? $user->photo->file  : 'no photo' }}" >
                     </td>
 
                   
                    <td>
                        @foreach ($user->roles as $user_role)
                       <br> {{$user_role->name }} <br/>
                        
                        @endforeach
                    </td>
                
                   
                    <td>{{$user->email}}</td>
                    {{-- <td>{{$user->is_active==1 ?'active' :'not active'}}</td>
                 --}}
              {{--    <td class="py-4 px-6 {{ $user->is_active ? 'text-green-500' : 'text-gray-500' }} ">
                    {{ $user->is_active ? 'Active' : 'Not Active'}}
               </td>  --}} 
               
             
              
                    <td>
                        {!! Form::open(array('method' => 'delete', 'route' =>array('delete.user', $user->id )))!!}
                              
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
 

@endsection


@section('table scripts')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script> 
    @endsection
    
    
    
</x-admin-master>