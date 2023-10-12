<x-admin-master>
    @section('content')

        
    <h1>Editing Permissions</h1>


<div class="row">
    <div class="col-sm-8">

    {!! Form::open(array('method' => 'put', 'route' => array('perm.update',$perm_edit)))!!}

            <div class="form-group">
                <div class="col-sm-6">

                {!! Form::label ('nameee','Role Name')!!}
                <input type='text' name='name' value='{{$perm_edit->name}}'  class="form-control">

            </div>
            </div>
                   <div class="form-group">
                  {!! Form::submit ('update Permission',['class'=>'btn btn-info'])!!}
   
                 </div>
    {!! Form::close() !!}
</div>
</div>
        
  
  
    
      
       
    @endsection
</x-admin-master>   