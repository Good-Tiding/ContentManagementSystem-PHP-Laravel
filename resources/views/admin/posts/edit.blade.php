<x-admin-master>
    @section('content')
      @include('ckeditor')  
        <h1>Editing Posts</h1>

        

        <form method="POST" action="{{ route('post.update', $post->slug) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf                      
          
            <input type="hidden" name="post_number" value="{{ $postNumber }}">
        
           <input type="hidden" name="page" value="{{ request('page') }}">
         
   


           {{--  @php
            dd($posts);
            @endphp --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control">
            </div>
        
            <div class="form-group">
              <label for="category_id">Choose a Category</label>
                <select name="category_id" class="form-control">
                 <option value="" {{ $post->category_id ? '' : 'selected' }}>Choose a category</option>
                    @foreach($categories as $category)
                     <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <img id="preview-image" height='200px' src="{{ $post->post_image ? $post->post_image : 'https://placehold.co/600x400' }}">
            </div>
    
            <div class="row">
                <div class="col-sm-3">
                    <input type="file" name="post_image" id="file" class="inputfile" />
                    <label for="file" class="file-label">Choose a file</label>
                </div>

                <div class="col-sm-9">
                    @if ($post->post_image && $post->post_image !== 'https://placehold.co/600x400')
                      
                        <button type="button" id="deleteButton" class="btn btn-danger delete_image">Delete Image</button>
                    @endif
                </div>

            </div>
    
             <br>
    
            <div class="form-group">
                <label for="body">Description:</label>
                <textarea id="editor" name="body" class="form-control"> {{ $post->body }} </textarea>
            </div>
    
            <button type="submit" class="btn btn-info">Update Post</button>
        </form>
       
    
    @endsection

    @section('table scripts')
        <script>
            const button = document.getElementById('deleteButton');
            button.addEventListener('click', () => {
                console.log('Delete button clicked');

                const formData = new FormData();
                formData.append('post', "{{ $post->id }}");

                fetch("{{ route('post.deletepostimage', $post) }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => {
                    console.log('Response received:', res);
                    if (res.ok) {
                        console.log('Image deleted successfully');
                    /*  button.remove(); */
                        // Reload the page or update the image display
                        location.reload();
                    } else {
                        console.error('Failed to delete image');
                    }
                })
                .catch(error => console.error('Error:', error));
            });

        </script>
        @include('view_image')
    @endsection    
</x-admin-master>
    
    
    