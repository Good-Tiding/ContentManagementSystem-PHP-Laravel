<div class="card my-4">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6">
        <ul class="list-unstyled mb-0">
          @if(count($categories)>0)

            @foreach ($categories as $category)
              <li>
                <a href="{{route('category.show',$category)}}">{{$category->name}}</a>
              </li>
            @endforeach

          @else


            @if(Auth::check())
            
              @if(auth()->user()->UserHasRole('Admin'))
                There is no categories yet you can  create a category <a href="{{route('category.index')}}">here </a>
              @else
                There is no categories yet 
              @endif

            @else
              There is no categories yet
            @endif 
          @endif
        </ul>
      </div> 
    </div>
  </div>
</div>
