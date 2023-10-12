<x-admin-master>


@section('content')

@if(Session::has('updating_message'))
    <div class='alert alert-primary' >
        {{Session::get('updating_message')}}
    </div>
@endif

    

    <h1>User Profile Of {{$user->username}}</h1>

    <div class='row'>
        <div class="col-sm-6">
        
            
            {!! Form::open(array('method' => 'put','files'=>'true','route' => array('profile.update',$user->id)))!!}   
            
            <div class='mb-4'> 
                <img width= '150' height='150' class="img-profile rounded-circle" src="{{$user->avatar}}">
        
            
        
        
            <div class="form-group">
                
            {!! Form::label ('avatar','old_photo_storage_link: ')!!}
            {!! Form::file ('avatar',['class'=>'form-control-file'])!!}
          
        
            </div>


          <div class='mb-4'> 
                <img width= '150' height='150' class="img-profile rounded-circle" src="{{$user->photo ? $user->photo->file  : 'http://placehold.it/400*400' }}">
            <div class="form-group">
                {!! Form::label ('photo_id','new_photo_model: ')!!}
                {!! Form::file ('photo_id',['class'=>'form-control-file'])!!}
              
            
                </div>
          </div>
        
            <div class="form-group">
        
                {!! Form::label ('username','UserName')!!}
                {!! Form::text ('username',"$user->username",['class'=>"form-control"
                ])!!}
                {{-- {{$errors->has('username') ? 'is-invalid' : '' }} --}}
         
            @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif 
           
        
            </div>

            <div class="form-group">
            <label for="name">Name</label>
 
            <input id="name" type="text" name="name" value="{{$user->name}}" class="form-control "@error('name') is-invalid @enderror">
             
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>


            <div class="form-group">
        
                {!! Form::label ('email','Email')!!}
                {!! Form::text ('email',"$user->email",['class'=>"form-control {{ $errors->first('email','is-invalid') }}"])!!}
             
             @error('email')
                  <div class="invalid-feedback">{{$message}}</div>     
                @enderror 
            </div>
        
            <div class="form-group">
        
                    {!! Form::label ('password','Password')!!}
                   
                    {!! Form::password ('password',['class'=>'form-control'])!!}
                 
               
            </div>
        
            <div class="form-group">
        
                {!! Form::label ('confirm_password','confirm Password')!!}
                {!! Form::password ('password',['class'=>'form-control'])!!}
             
              
           </div>
           <div class="form-group">
               {!! Form::submit ('update profile',['class'=>'btn btn-info'])!!}
           </div>  
                
                {!! Form::close() !!}
                       
               {{-- @include('error') --}}
        </div>
    </div>

  
            <div class="col-sm-12">
              <!-- DataTales Example -->
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
                            <th>Slug</th>
                           
                            <th>Attach</th>
                            <th>Detach</th>
                           
                        
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Options</th>
                            <th>Role_ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                           
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
                                 
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                  
                                    
                                    <td>
                                        {!! Form::open(array('method' => 'put', 'route' =>array('user.role.attach', $user->id )))!!}

                                        <input type="hidden" name='role' value={{$role->id}} >

                                        <button type='submit' class='btn btn-primary'

                                            @if ($user->roles->contains($role))
                                            disabled
                                            @endif 
                                            
                                            >
                                            
                                          Attach
                                        </button>
                                       
                                    
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                        
                                        {!! Form::open(array('method' => 'put', 'route' =>array('user.role.detach', $user->id )))!!}
                                        <input type="hidden" name='role' value={{$role->id}} >

                                        <button type='submit' class='btn btn-danger'

                                        @if (!$user->roles->contains($role))
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
            
            
     
            </div>
            </div>
        </div>
    
     

 @endsection

</x-admin-master>