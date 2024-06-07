

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">HOME</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto navbar-right">
      
          
        @if (Auth::check())
          @if(auth()->user()->UserHasRole('Admin'))
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
            </li>

          @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">User</a>
            </li>
          @endif
          <li class="nav-item">
            
            <a href="#" onclick="document.getElementById('logout-form').submit(); return false;" class="nav-link">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </li>



          @else
          {{-- ازا كان guest جاية يشوف وما عمل تسجسل او دخول --}}
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
          </li>


          @endif
        
        </ul>
      </div>
    </div>
  </nav>