
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


<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">User Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Picture</th>

                <th>Created_at</th>
                <th>created_by</th>
                <th>Updated_at</th>
                <th>Updated_by</th>
                <th>Deleted_at</th>
                <th>Deleted_by</th>

                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach ( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td>{{ $user->picture_id }}</td>
                    {{-- <td>
                        @if(isset($user->childCategories))
                            @foreach($user->childCategories as $childuser)
                         {{ $childuser->subcat_name }}
                            @endforeach
                       @endif
                    </td> --}}
                    {{-- <td>
                        @if(isset($user->childCategories))
                            {{ $user->childCategories->count() }}
                        @endif
                    </td> --}}
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->created_by_id }}</td>
        
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->updated_by_id }}</td>
        
                    <td>{{ $user->deleted_at }}</td>
                    <td>{{ $user->deleted_by_id }}</td>
        
                    {{-- <td>
                        <a href="{{ route('edit_user',$user->id) }}" class="btn btn-warning">Edit</a>
                    </td> --}}
                    <td>
                        <form action="{{ route('delete_user',$user->id) }}" method="POST">
                            @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form> 
        
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->


  @endsection

