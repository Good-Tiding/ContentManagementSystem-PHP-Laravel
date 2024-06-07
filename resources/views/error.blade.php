@if (count($errors)>0)          
 <div class="alert alert-danger">
    <ul>
      <div class="form-group">
        @if($errors->any())
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li> 
            {{-- <div class="alert alert-danger">{{$error}}</div>   --}}
          @endforeach
        @endif
      </div>  
    </ul>
  </div>
@endif


