<x-admin-master>
@section('content')

  {{-- @include('tinyeditor')   --}}


<h1>Creating Posts</h1>

<div class="row-sm-6">

{!! Form::open(array('method' => 'post','files'=>'true', 'route' => 'post.store'))!!}
    {{-- {!! Form:: model(['method' => 'post','route' => ['post.store']])!!} --}}

    <div class="form-group">

    {!! Form::label ('title','Title')!!}
    {{-- {!!{!! Form::label($for, $text, [$options]) !!}!!} --}}

    {!! Form::text ('title','',['class'=>'form-control','placeholder'=>'Enter a title'])!!}
    {{-- {!! {!! Form::text($name, $value, [$options]) !!}!!} --}}
    
    </div>

    <div class="form-group">
        
    {!! Form::label ('category_id','Choose a Category')!!}
    {!! Form::select (
    'category_id',[''=>'Choose a category'] + $categories,null,['class'=>'form-control'])!!}

   
    </div>

    {!! Form::label ('post_image','File')!!}
    {!! Form::file ('post_image',['class'=>'form-control-file'])!!}
    {!! Form::label ('')!!}
    
    <div class="form-group">
    {!! Form::label ('body','Description')!!}
    {!! Form::textarea('body',null,['class'=>'form-control'])!!}
    </div>
    
    <div class="form-group">
    {!! Form::submit ('create post',['class'=>'btn btn-info'])!!}
    </div>
    
    {!! Form::close() !!}




</div>



<div class="row-sm-9">
    @include('error')
 
 </div>


  @endsection
 
</x-admin-master>


