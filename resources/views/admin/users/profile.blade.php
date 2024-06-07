<x-admin-master>
    @section('content')
      @include('timeout-flasmessage')
      @include('error')
        @if(Session::has('updating_message'))
            <div class='alert alert-primary' >{{Session::get('updating_message')}}</div>

        @elseif (session('deleting_user_image_message'))
          <div class='alert alert-danger' >{{session('deleting_user_image_message')}}</div>

        @endif
    
        @if ($user->roles->isNotEmpty())
            <h1> User Profile Of <strong>{{$user->username}}</strong> with role(s) :
            {{ $user->roles->pluck('name')->implode(', ') }}
            </h1>
        @else
          <h1>User Profile Of <strong>{{$user->username}}</strong></h1>
        @endif
    
        <div class='row'>
           <div class="col-sm-6">
                <form method="post" action="{{ route('profile.update', $user->slug) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                    <div class='mb-4'>
                        <img id="preview-image" width='150' height='100' class="img-profile rounded-circle" src="{{ $user->userphoto ? $user->userphoto->file : 'https://placehold.co/600x400' }}">
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="file" name="photo_id" id="file" class="inputfile" />
                            <label for="file" class="file-label">Choose a file</label>
                        </div>
                        <div class="col-sm-9">
                            @if ($user->userphoto && $user->userphoto->file !== 'https://placehold.co/600x400')    
                             {{--  <input type="hidden" id="imageDeletedField" name="image_deleted" value="false"> --}}
                                <button type="button" id="deleteButton" class="btn btn-danger delete_user_image" >Delete Image</button>
                               
                              @endif   
                        </div>
                    </div>

                    
                       
                    
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control">
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" value="{{ $user->name }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="password_confirmation" class="form-control">
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update Profile</button>
                    </div>
                </form>    
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Your Roles Assign Table </h6>
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

    @section('table scripts')
        @include('delete_user_profile')
        @include('view_image')
    @endsection 
</x-admin-master>