@extends("admin.layouts.admin")
@section("title","Xsdf")

@section("header_top")
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection



@section("content")
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Add post</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form action = {{ route('post_comments.store') }} method="POST" enctype="multipart/form-data">
  @csrf

@include('admin.posts.post_comment_form')
</form>
</div>
@endsection