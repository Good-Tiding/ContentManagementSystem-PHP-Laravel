<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePhoto" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>MediaPhoto</span>
    </a>
    <div id="collapsePhoto" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">MediaPhoto</h6>
        {{--  --}}
        <a class="collapse-item" href="{{route('mediaphoto.index')}}"> All Photo</a>
        <a class="collapse-item" href="{{route('mediaphoto.upload')}}">Upload Photo</a>
      </div>
    </div>
  </li>
