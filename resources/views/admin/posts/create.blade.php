<x-admin-master>
  @section('content')
    @include('ckeditor')  
    <h1>Creating Posts</h1>

    <div class="row-sm-6">
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" placeholder="Enter a title">
            </div>

            <div class="form-group">
              <label for="category_id">Choose a Category</label>
                <select name="category_id" class="form-control">
                  <option value="">Choose a category</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            
              {{--  <label for="post_image">File</label>
              <input type="file" name="post_image" class="form-control-file">
            </div> --}}

            <div class='mb-4'>
              <img id="preview-image" width='150' height='150'  src="{{ $post->post_image ? $post->post_image: 'https://placehold.co/600x400' }}">
          </div>

            <div class="form-group">
              <input type="file" name="post_image" id="file" class="inputfile" />
              <label for="file" class="file-label">Choose a file</label>
          </div>

            <div class="form-group">
              <label for="body">Description</label>
              <textarea id="editor" name="body" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-info">Create Post</button>
            </div>
        </form>
    </div>

    <div class="row-sm-9">
        @include('error')
    </div>
    
   @include('view_image')
  @endsection
</x-admin-master>

