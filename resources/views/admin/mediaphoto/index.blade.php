<x-admin-master>

    @section('content')
        <h1> Show Media </h1>


<!-- DataTales Example -->

@if(Session::has('deleting_message'))
<div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>

@elseif(Session::has('Cannot_delete_message'))
<div class='alert alert-danger' >{{Session::get('Cannot_delete_message')}}</div>
@endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Media Table</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
               
                
            <thead>
                <tr>
                    <th>MEDIA_ID</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Created</th>
                    <th>Email</th>
                    <th>Delete</th>
                   
                    
                
                </tr>
            </thead>
    
            <tfoot>
                <tr>
                    <th>MEDIA_ID</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Created</th>
                    <th>Email</th>
                    <th>Delete</th>
                  
                </tr>
            </tfoot>
    
            <tbody>
                @foreach ($photos as $photo)
                  @foreach ($users as $user)
                    <tr>
                       
                           
                            <td>{{$photo->id}}</td>
                           <td>{{$user->name}}</td>
                            <td>
                                
                                 <img  height="60px" src="{{ $photo->file ? $photo->file : 'no photo'}}" ></td>
                                
                            <td>{{$photo->created_at ? $photo->created_at->diffForHumans() :'no date'}}</td>
                            
                            
                            <td>{{$user->email}}</td> 
                            <td>
                   
                           
                                {!! Form::open(array('method' => 'delete', 'route' =>array('mediaphoto.destroy', $photo)))!!}
                                      
                                {!! Form::submit ('Delete',['class'=>'btn btn-danger'])!!}
                            
                                {!! Form::close() !!}
                           
                            </td> 
                           
                      
        
                    </tr>
                    @endforeach
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