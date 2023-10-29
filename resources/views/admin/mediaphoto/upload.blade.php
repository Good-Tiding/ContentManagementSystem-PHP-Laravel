<x-admin-master>

    @section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
 @endsection

    @section('content')
        <h1> Upload Media </h1>
        {!! Form::open(array('method' => 'post','class '=>'dropzone', 'route' => 'mediaphoto.store'))!!}
        {!! Form::close() !!}

     @endsection

     @section('dropzone script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js'></script>
    @endsection

</x-admin-master>