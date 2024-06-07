<x-admin-master>
    @section('content')
     @include('timeout-flasmessage')
        
      <h1>Editing Categories</h1>
        <div class="row">
            <div class="col-sm-8">

                <form method="POST" action="{{ route('category.update', $category->slug) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="name">Category Name</label>
                            <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <input type="submit" value="Edit Category" class="btn btn-info">
                    </div>
                </form>
                 
            </div>
        </div>  
       
    @endsection
</x-admin-master>   