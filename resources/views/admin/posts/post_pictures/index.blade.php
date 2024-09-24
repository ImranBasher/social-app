@extends('admin.layouts.admin')
@section('title', 'Xsdf')

@section('header_top')
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






@section('content')

    <div>
        <div>
            <a href="{{ route('post_pictures.create') }}" class="btn btn-info">Add Post</a>
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
                                        <th>ID</th>
                                        <th>Post_Id</th>
                                        <th>Picture_ID</th>
                                        <th>user_id</th> {{-- picture_id (make relation to show images) --}}

                                        <th>Is_active</th>

                                        <th>Created_at</th>
                                        <th>created_by</th>

                                        <th>Updated_at</th>
                                        <th>Updated_by</th>

                                        <th>Deleted_at</th>
                                        <th>Deleted_by</th>

                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($post_pictures as $post_picture)
                                        <tr>
                                            <td>{{ $post_picture->id }}</td>
                                            {{-- <td></td> --}}
                                            <td>{{ $post_picture->post_id }}</td>
                                            <td>{{ $post_picture->picture_id }}</td>
                                            <td>{{ $post_picture->user_id }}</td>
                                            <td>{{ $post_picture->is_active }}</td>
                                            {{-- <td>
                @if (isset($post_picture->childCategories))
                    @foreach ($post_picture->childCategories as $childpost_picture)
                 {{ $childpost_picture->subcat_name }}
                    @endforeach
               @endif
            </td> --}}
                                            {{-- <td>
                @if (isset($post_picture->childCategories))
                    {{ $post_picture->childCategories->count() }}
                @endif
            </td> --}}
                                            <td>{{ $post_picture->created_at }}</td>
                                            <td>{{ $post_picture->created_by_id }}</td>

                                            <td>{{ $post_picture->updated_at }}</td>
                                            <td>{{ $post_picture->updated_by_id }}</td>

                                            <td>{{ $post_picture->deleted_at }}</td>
                                            <td>{{ $post_picture->deleted_by_id }}</td>

                                            {{-- <td>
                                                <a href="{{ route('post_pictures.edit', $post_picture->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('post_pictures.destroy', $post_picture->id) }}"
                                                    method="post_picture">
                                                    @csrf
                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>

                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <br>
             <div>
                 {{ $post_pictures->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
 @endsection
