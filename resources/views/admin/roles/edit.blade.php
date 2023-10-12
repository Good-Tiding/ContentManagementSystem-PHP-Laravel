<x-admin-master>
    @section('content')

        
    <h1>Editing Roles</h1>


<div class="row">
    <div class="col-sm-8">

    {!! Form::open(array('method' => 'put', 'route' => array('role.update',$role_edit)))!!}

            <div class="form-group">
                <div class="col-sm-6">

                {!! Form::label ('nameee','Role Name')!!}
                <input type='text' name='name' value='{{$role_edit->name}}'  class="form-control">

            </div>
            </div>
                   <div class="form-group">
                  {!! Form::submit ('update role',['class'=>'btn btn-info'])!!}
   
                 </div>
    {!! Form::close() !!}
</div>
</div>
        
    <div class="row">
        <!-- DataTales Example -->
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
                        <th>Slug</th>
                        <th>Attach</th>
                        <th>detach</th>
                        
                       
                        
                    
                    </tr>
                </thead>
        
                <tfoot>
                    <tr>
                        <th>Options</th>
                        <th>Permission_ID</th>
                        <th>Name</th>
                        <th>Slug</th>
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
                            <td>{{$perm->id}}</td>
                            <td>{{$perm->name}}</a></td>
                            <td>{{$perm->slug}}</td>
                           

                            <td>
                                {!! Form::open(array('method' => 'put', 'route' =>array('role.perm.attach', $role_edit->id )))!!}

                                <input type="hidden" name='permission' value={{$perm->id}} >

                                <button type='submit' class='btn btn-primary'

                                    @if ($role_edit->permissions->contains($perm))
                                    disabled
                                    @endif 
                                    
                                    >
                                    
                                  Attach
                                </button>
                               
                            
                                {!! Form::close() !!}
                            </td>

                            <td>
                                
                                {!! Form::open(array('method' => 'put', 'route' =>array('role.perm.detach', $role_edit->id )))!!}
                                <input type="hidden" name='permission' value={{$perm->id}} >

                                <button type='submit' class='btn btn-danger'

                                @if (!$role_edit->permissions->contains($perm))
                                disabled
                                @endif 
                                
                                >
                                Detach

                            </button>
                            
                                {!! Form::close() !!}
                            </td>
                           
                      
        
                    </tr>
                    @endforeach
                            
                </tbody>
                </table>
                </div>
            </div>

            @endif
                </div>
    </div>
    </div>
  
    
      
       
    @endsection
</x-admin-master>   