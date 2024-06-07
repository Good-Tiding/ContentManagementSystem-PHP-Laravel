<x-admin-master>
    @section('styles')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    @endsection

    @section('content')
        <h1>Upload Media</h1>
        <p id="file-counter">Files Uploaded: 0</p>
        <form method="post" class="dropzone" action="{{ route('mediaphoto.store') }}" id="my-dropzone">
            @csrf 
            <input type="hidden" name="fileCounter" id="fileCounterInput">
        </form>   
    @endsection

    @section('dropzone script')
      <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js'></script>
        <script>
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("#my-dropzone");
            var fileCounter = 0;
        
            myDropzone.on("queuecomplete", function() {
                    // Set the value of fileCounter to the hidden input field before submitting the form
                    document.getElementById('fileCounterInput').value = fileCounter;
                // Redirect the user to the index page after all files are uploaded
                window.location.href = "{{ route('mediaphoto.index') }}";
            });
            
            myDropzone.on("success", function(file) {
                fileCounter++;
                document.getElementById('file-counter').innerText = "Files Uploaded: " + fileCounter;
            });
        </script>
    @endsection  
</x-admin-master>
