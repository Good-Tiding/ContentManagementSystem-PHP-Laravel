<script>
    document.getElementById('file').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
  </script>

  {{-- In this script:

1. We listen for the change event on the file input element with id="file".
2. When a file is selected, we create a new FileReader object.
3. We define an onload event handler for the FileReader object that sets the src attribute of the image with id="preview-image" to the result of the file read operation.
4. We call readAsDataURL on the FileReader object, passing in the file that was selected. This method reads the content of the file and returns a data URL that can be used as a source for the image. --}}
