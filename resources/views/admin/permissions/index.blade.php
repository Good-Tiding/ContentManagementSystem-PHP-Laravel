<x-admin-master>

    @section('content')
        <h1>   Permissions </h1>

   

    <div class="row">
        <div class="col-sm-3">

        {!! Form::open(array('method' => 'post', 'route' => 'perm.store'))!!}

            <div class="form-group">

                {!! Form::label ('nameee','Permission Name')!!}
                <input type='text' name='name'  class="form-control
                 
                @error('name')
                is-invalid 
                @enderror
                
                ">
           
                <div>
                    @error('name')
                    <span><strong>{{$message}}</strong></span>
                        
                    @enderror
                </div>

            </div>

               {!! Form::submit ('create permission',['class'=>'btn btn-info'])!!}
   
    
        {!! Form::close() !!}
    </div>
    
<!-- DataTales Example -->
    <div class="col-sm-9">


<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Permissions Table</h6>
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
                <th>Permission_ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Delete</th>
               
                
            
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Permission_ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Delete</th>
              
            </tr>
        </tfoot>

        <tbody>
            @foreach ($perm_index as $perm)
            <tr>
               
                   
                    <td>{{$perm->id}}</td>
                    <td><a href="{{route('perm.edit',$perm->id)}}">{{$perm->name}}</a></td>
                    <td>{{$perm->slug}}</td>
                    <td>
                        {!! Form::open(array('method' => 'delete', 'route' =>array('perm.delete', $role->id )))!!}
                              
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
        </div>
    </div>
 



    
    @endsection
    
    
    
</x-admin-master>