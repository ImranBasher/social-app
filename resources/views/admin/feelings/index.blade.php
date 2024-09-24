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
    <a href="{{ route('feelings.create') }}" class="btn btn-info">Add Feeling</a>
  </div>
  <div> 

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Is_Active</th>


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
        @foreach ( $feelings as $feeling )
        <tr>
            <td>{{ $feeling->id }}</td>
            <td>{{ $feeling->feeling_name }}</td>
            <td>{{ $feeling->is_active }}</td>

            {{-- <td>
                @if(isset($feeling->childCategories))
                    @foreach($feeling->childCategories as $childfeeling)
                 {{ $childfeeling->subcat_name }}
                    @endforeach
               @endif
            </td> --}}
            {{-- <td>
                @if(isset($feeling->childCategories))
                    {{ $feeling->childCategories->count() }}
                @endif
            </td> --}}
            <td>{{ $feeling->created_at }}</td>
            <td>{{ $feeling->created_by_id }}</td>

            <td>{{ $feeling->updated_at }}</td>
            <td>{{ $feeling->updated_by_id }}</td>

            <td>{{ $feeling->deleted_at }}</td>
            <td>{{ $feeling->deleted_by_id }}</td>

            <td>
                <a href="{{ route('feelings.edit',$feeling->id) }}" class="btn btn-warning">Edit</a>
            </td>
            <td>
                <form action="{{ route('feelings.destroy',$feeling->id) }}" method="POST">
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
      {{ $feelings->links('pagination::bootstrap-5') }}
  </div>
  </div>
</div>




























@endsection