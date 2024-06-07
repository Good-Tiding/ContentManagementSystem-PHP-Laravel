<x-admin-master>
  @section('content')
    @include('timeout-flasmessage')
    <h1> Show Media </h1>

    @if(Session::has('deleting_message'))
    <div class='alert alert-danger' >{{Session::get('deleting_message')}}</div>

    @elseif(Session::has('Cannot_delete_message'))
    <div class='alert alert-danger' >{{Session::get('Cannot_delete_message')}}</div>

    @elseif(Session:: has('deleting_checked_message'))
    <div class='alert alert-danger' >{{Session::get('deleting_checked_message')}}</div>

    @elseif(Session::has('uploading_message'))
    <div class='alert alert-success' >{{Session::get('uploading_message')}}</div>
                
    @endif

    @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif


    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Media Table</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          @if($uploadphotos)
            {{--   'method' => 'post',     كانت ما عم تزبطط الا لما حطيت بوست --}}
            {!! Form::open(array('method' => 'delete', 'route' => 'mediaphoto.deletechecked'))!!}
              <div class="delete-all-button">
                <input type="submit" value="Delete Selected" class="btn btn-danger" id="blurButton" disabled >
              </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="selectAll" ></th>
                      <th>MEDIA_ID</th>
                      <th>Photo</th>
                      <th>Created</th>
                    </tr>
                  </thead>
    
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>MEDIA_ID</th>
                      <th>Photo</th>
                      <th>Created</th> 
                    </tr>
                  </tfoot>

                  <tbody>
                    @foreach ($uploadphotos as $photo)
                      <tr>
                        <td> <input class="deleteCheckBox" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"> </td>
                        <td>{{$loop->iteration}}</td>
                        <td>            
                          <img  height="60px" src="{{ $photo->file ? $photo->file : 'https://placehold.co/600x400'}}" ></td> 
                        <td>{{$photo->created_at ? $photo->created_at->diffForHumans() :'no date'}}</td>
                      </tr> 
                    @endforeach 
                  </tbody> 
                </table>         
              {!! Form::close() !!}
            @endif   
          </div>   
        </div>
      </div>              
    @endsection

    @section('table scripts')
      <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
      {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script>  --}}
      <script>
        $('#selectAll').click(function()
        {
          if(this.checked)
            {
              $('.deleteCheckBox').each(function()
              {
                this.checked=true;
                $('#blurButton').prop('disabled', false);
              });
            }

          else
            {
              $('.deleteCheckBox').each(function()
              {
                this.checked=false;
                $('#blurButton').prop('disabled', true);
              });
            }
            // console.log('the checkbox select all is working');
        }
      );
    </script>
    <script>                
        $('.deleteCheckBox').click(function() 
        {
          if ($('.deleteCheckBox:checked').length > 0)
            {
                $('#blurButton').prop('disabled', false);
            } 
          else 
            {
                $('#blurButton').prop('disabled', true);
            }
        } 
      );
    </script> 
    <script>
      const selectAllCheckbox = document.getElementById('selectAll');
      const deleteCheckboxes = document.querySelectorAll('.deleteCheckBox');
      // Add event listener to each delete checkbox
      deleteCheckboxes.forEach(checkbox => 
      {
        checkbox.addEventListener('change', () => 
        {
          // Check if all delete checkboxes are selected
          const allSelected = [...deleteCheckboxes].every(checkbox => checkbox.checked);
          // If all delete checkboxes are selected, check the select all checkbox
          if (allSelected) 
          {
            selectAllCheckbox.checked = true;
          } 
          else 
          {
            selectAllCheckbox.checked = false;
          }
        });
      });
    </script>   
  @endsection       
</x-admin-master>