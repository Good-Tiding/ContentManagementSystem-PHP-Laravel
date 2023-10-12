<x-admin-master>
@section('content')

<h1>Creating Posts</h1>
{!! Form::open(array('method' => 'post','files'=>'true', 'route' => 'post.store'))!!}
    {{-- {!! Form:: model(['method' => 'post','route' => ['post.store']])!!} --}}

    <div class="form-group">

    {!! Form::label ('title','Title')!!}
    {{-- {!!{!! Form::label($for, $text, [$options]) !!}!!} --}}

    {!! Form::text ('title','',['class'=>'form-control','placeholder'=>'enter a title'])!!}
    {{-- {!! {!! Form::text($name, $value, [$options]) !!}!!} --}}
    
    </div>
   


    {!! Form::label ('post_image','File')!!}
    {!! Form::file ('post_image',['class'=>'form-control-file'])!!}
    {!! Form::label ('')!!}
    
    <div class="form-group">
    {!! Form::textarea('body',null,['class'=>'form-control'])!!}
    </div>
    
    {!! Form::submit ('create post',['class'=>'btn btn-info'])!!}
   
    
{!! Form::close() !!}


@endsection

</x-admin-master>


