<x-admin-master>
    @section('content')
      @include('timeout-flasmessage')
      @include('error')
     {{--  @include('delete_user_profile')
      @include('view_image') --}}

        @if(Session::has('updating_message'))
            <div class='alert alert-primary' >{{Session::get('updating_message')}}</div>
        @elseif (session('deleting_user_image_message'))
            <div class='alert alert-danger' >{{session('deleting_user_image_message')}}</div>
        @endif
      

       {{--   @foreach ($user->roles as $user_role)
          <h1> User Profile Of <strong>{{$user->username}}</strong> with role <strong>{{$user_role->name }}</strong> </h1>
         @endforeach --}}

                @if ($user->roles->isNotEmpty())
                   <h1> User Profile Of <strong>{{$user->username}}</strong> with role(s) :
                   {{ $user->roles->pluck('name')->implode(', ') }}
                   </h1>
                @else
                  <h1>User Profile Of <strong>{{$user->username}}</strong></h1>
                @endif
        <div class='row'>
            <div class="col-sm-6">
                <form method="post" action="{{ route('profile.update', $user->slug) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class='mb-4'>
                        <img  id="preview-image" width='150' height='100' class="img-profile rounded-circle" src="{{ $user->userphoto ? $user->userphoto->file : 'https://placehold.co/600x400' }}"> 
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <input type="file" name="photo_id" id="file" class="inputfile" />
                            <label for="file" class="file-label">Choose a file</label>
                        </div>
                        <div class="col-sm-9">
                            @if ($user->userphoto && $user->userphoto->file !== 'https://placehold.co/600x400')
                                <button type="button" id="deleteButton" class="btn btn-danger delete_user_image">Delete Image</button>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}">
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
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                
                    <div class="form-group">
                        <label for="confirm_password">Confirm Your Password</label>
                        <input type="password" id="confirm_password" name="password_confirmation" class="form-control">
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-info col-sm-6">Update Profile</button>
                    </div>
                </form>   
            </div>
        </div>   
    @endsection

    @section('table scripts')
        @include('delete_user_profile')
        @include('view_image')
    @endsection 
</x-admin-master>
    