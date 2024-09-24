<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield("title",'Admin') | Dashboard</title>
      @include('admin.includes.header_script')
      @yield("css")
      @yield("style")
      
  </head>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>

      @include('admin.includes.admin-navbar')
    


      @include('admin.includes.admin-sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        
        <div class="content-header">
          <div class="container-fluid">
            {{-- As Breadcrumb Header --}}
            @yield("header_top")
          </div><!-- /.container-fluid -->
        </div>


        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

              {{-- Page Main Content  --}}
              @yield("content")
        
          </div><!-- /.container-fluid -->
        </section>
     </div> 
    </div>

  @include('admin.includes.footer')

  


  