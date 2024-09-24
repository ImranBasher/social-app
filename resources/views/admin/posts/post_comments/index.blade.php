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
            <a href="{{ route('post_comments.create') }}" class="btn btn-info">Add Post Comment</a>
        </div>
        <div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post Comment Table</h3>

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
                                        <th>Comment_Body</th>
                                        <th>Post_id</th>
                                        <th>user_id</th>


                                        <th>Is_active</th>

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
                                    @foreach ($post_comments as $post_comment)
                                        <tr>
                                            <td>{{ $post_comment->id }}</td>
                                            <td></td>
                                            <td>{{ $post_comment->comment_body }}</td>
                                            <td>{{ $post_comment->post_id }}</td>
                                            <td>{{ $post_comment->user_id }}</td>
                                            <td>{{ $post_comment->is_active }}</td>

                                            <td>{{ $post_comment->created_at }}</td>
                                            <td>{{ $post_comment->created_by_id }}</td>

                                            <td>{{ $post_comment->updated_at }}</td>
                                            <td>{{ $post_comment->updated_by_id }}</td>

                                            <td>{{ $post_comment->deleted_at }}</td>
                                            <td>{{ $post_comment->deleted_by_id }}</td>

                                            <td>
                                                <a href="{{ route('post_comments.edit', $post_comment->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('post_comments.destroy', $post_comment->id) }}"
                                                    method="post_comment">
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
                                {{ $post_comments->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
                @endsection
