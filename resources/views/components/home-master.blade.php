<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Blog Home - Start Bootstrap Template</title>
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/lib.css')}}">
  <link rel="stylesheet" href="{{asset('css/blog-home.css')}}" >
</head>

<body>
  <!-- Navigation -->
  <x-home.topbar.home-topbar></x-home.topbar.home-topbar>
  
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-8">
        @yield('content')
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Search Widget -->
        <x-home.sidebar.home-sidebar-search > </x-home.sidebar.home-sidebar-search>
        
        <!-- Categories Widget -->
        <x-home.sidebar.home-sidebar-categories> </x-home.sidebar.home-sidebar-categories>
        
      
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-3 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; CMS system {{\Carbon\Carbon::now()->year}}</p>
    </div>
    
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  @yield('scripts-blog')
</body>

</html>
