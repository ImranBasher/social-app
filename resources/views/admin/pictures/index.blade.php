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

<div> 
  <div>
    <a href="{{ route('pictures.create') }}" class="btn btn-info">Add Picture</a>
  </div>
  <div> 

    <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">User Table</h3>

                  <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="table_search" class="form-control float-right"
                              placeholder="Search">

                          <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                  <i class="fas fa-search"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Picture</th> {{-- picture_id (make relation to show images) --}}
        
        <th scope="col">Created_at</th>
        <th scope="col">created_by</th>

        <th scope="col">Updated_at</th>
        <th scope="col">Updated_by</th>

        <th scope="col">Deleted_at</th>
        <th scope="col">Deleted_by</th>

        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ( $pictures as $picture )
        <tr>
            <td>{{ $picture->id }}</td>
            <td>{{ $picture->pic_name }}</td>

            <td><img src="{{ asset('storage/'.$picture->pic_name) }}"  height = "100px" width = "100px"> </td>
           
            <td>{{ $picture->created_at }}</td>
            <td>{{ $picture->created_by_id }}</td>

            <td>{{ $picture->updated_at }}</td>
            <td>{{ $picture->updated_by_id }}</td>

            <td>{{ $picture->deleted_at }}</td>
            <td>{{ $picture->deleted_by_id }}</td>

            <td>
                <a href="{{ route('pictures.edit',$picture->id) }}" class="btn btn-warning">Edit</a>
            </td>
            <td>
                <form action="{{ route('pictures.destroy',$picture->id) }}" method="POST">
                    @csrf
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form> 

            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
  <br>
  <br>
  <div>
      {{ $pictures->links('pagination::bootstrap-5') }}
  </div>
  </div>
</div>




























@endsection