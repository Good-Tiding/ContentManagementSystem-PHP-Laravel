<x-admin-master>

    @section('content')
        <h1> Creating Categories </h1>

   

    <div class="row">
        <div class="col-sm-3">

        {!! Form::open(array('method' => 'post', 'route' => 'categories.store'))!!}

            <div class="form-group">

                {!! Form::label ('nameee','Categories Name')!!}
                <input type='text' name='name'  class="form-control
                 
                @error('name')
                is-invalid 
                @enderror
                
                ">
           
                <div>
                    @error('name')
                    <span><strong>{{$message}}</strong></span>
                        
                    @enderror
                </div>

            </div>

               {!! Form::submit ('create category',['class'=>'btn btn-info'])!!}
   
    
        {!! Form::close() !!}
    </div>
    
<!-- DataTales Example -->
    <div class="col-sm-9">


<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

           
            
        <thead>
            <tr>
                <th>Category_ID</th>
                <th>Name</th>
                
                <th>Delete</th>
               
                
            
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Category_ID</th>
                <th>Name</th>
                
                <th>Delete</th>
              
            </tr>
        </tfoot>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                   
                       
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('categories.edit',$category->id)}}">{{$category->name}}</a></td>
                        
                        <td>
                            {!! Form::open(array('method' => 'delete', 'route' =>array('categories.destroy', $category)))!!}
                                  
                            {!! Form::submit ('Delete',['class'=>'btn btn-danger'])!!}
                        
                            {!! Form::close() !!}
    
                        </td>
                       
                  
    
                </tr>
                @endforeach
                    
        </tbody>
        </table>
        </div>
    </div>

</div>
        </div>
    </div>
 



    
    @endsection
    
    
    
</x-admin-master>