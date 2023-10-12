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
                    <img width= '150' height='150' class="img-profile rounded-circle" src="{{$user->photo ? $user->photo->file  : 'no photo' }}">

                <div class="form-group">
                    {!! Form::label ('photo_id','new_photo_model: ')!!}
                    {!! Form::file ('photo_id',['class'=>'form-control-file'])!!}
                  
                
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

                        @if ($errors->has('password'))
                         <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif 
                     
                   
                </div>
            
                <div class="form-group">
            
                    {!! Form::label ('confirm_password','Confirm Your Password')!!}
                    {!! Form::password ('password',['class'=>'form-control'])!!}

                  
                  
               </div>
               <div class="form-group">
                   {!! Form::submit ('update profile',['class'=>'btn btn-info col-sm-6 '])!!}
               </div>  
                    
                    {!! Form::close() !!}
                           
                   {{-- @include('error') --}}
            </div>
        </div>

        </div>
    @endsection
</x-admin-master>
    