<x-admin-master>
    @section('content')

        
    <h1>Editing Categories</h1>


<div class="row">
    <div class="col-sm-8">

    {!! Form::open(array('method' => 'put', 'route' => array('categories.update',$category_edit)))!!}

            <div class="form-group">
                <div class="col-sm-6">

                {!! Form::label ('nameee','Category Name')!!}
                <input type='text' name='name' value='{{$category_edit->name}}'  class="form-control">

            </div>
            </div>
                   <div class="form-group">
                  {!! Form::submit ('Edit Category',['class'=>'btn btn-info'])!!}
   
                 </div>
    {!! Form::close() !!}
</div>
</div>
        
    


              
    </div>
    </div>
  
    
      
       
    @endsection
</x-admin-master>   