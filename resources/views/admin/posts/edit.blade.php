<x-admin-master>
  @section('content')
    
    <h1>Editing Posts</h1>
    {!! Form::open(array('method' => 'put','files'=>'true', 'route' => array('post.update',$post->id)))!!}   
    
        <div class="form-group">
    
        {!! Form::label ('titleee','Title')!!}
        {{-- {!!{!! Form::label($for, $text, [$options]) !!}!!} --}}
    
        {!! Form::text ('title',"$post->title",['class'=>'form-control'])!!}
        {{-- {!! {!! Form::text($name, $value, [$options]) !!}!!} --}}
        
        </div>
       
    
    
        {!! Form::label ('post_image','File')!!}
        <div  class="form-group"><img height='200px'src="{{$post->post_image}}"></div>

       
        {!! Form::file ('post_image',['class'=>'form-control-file'])!!}
        {!! Form::label ('')!!}
      
        
        <div class="form-group">
        {!! Form::textarea('body',"$post->body",['class'=>'form-control'])!!}
        </div>
        
        {!! Form::submit ('update post',['class'=>'btn btn-info'])!!}
       
        
    {!! Form::close() !!}
  @endsection
    
    </x-admin-master>
    
    
    