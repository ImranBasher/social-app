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
            <a href="{{ route('comment_replies.create') }}" class="btn btn-info">Add Post</a>
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
                                        <th>Comment Reply Body</th>
                                        <th>Post_Id</th>
                                        <th>Post Comment ID</th>
                                        <th>User ID</th>
                                        

                                        <th>Is Active</th>

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
                                    @foreach ($comment_replies as $comment_reply)
                                        <tr>
                                            <td>{{ $comment_reply->id }}</td>
                                            <td>{{ $comment_reply->comment_reply_body }}</td>
                                            <td>{{ $comment_reply->post_id }}</td>
                                            <td>{{ $comment_reply->post_comment_id }}</td>
                                            <td>{{ $comment_reply->user_id }}</td>

                                            <td>{{ $comment_reply->is_active }}</td>

                                            {{-- <td>
                @if (isset($comment_reply->childCategories))
                    @foreach ($comment_reply->childCategories as $childcomment_reply)
                 {{ $childcomment_reply->subcat_name }}
                    @endforeach
               @endif
            </td> --}}
                                            {{-- <td>
                @if (isset($comment_reply->childCategories))
                    {{ $comment_reply->childCategories->count() }}
                @endif
            </td> --}}

                                            <td>{{ $comment_reply->created_at }}</td>
                                            <td>{{ $comment_reply->created_by_id }}</td>

                                            <td>{{ $comment_reply->updated_at }}</td>
                                            <td>{{ $comment_reply->updated_by_id }}</td>

                                            <td>{{ $comment_reply->deleted_at }}</td>
                                            <td>{{ $comment_reply->deleted_by_id }}</td>

                                            <td>
                                                <a href="{{ route('comment_replies.edit', $comment_reply->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('comment_replies.destroy', $comment_reply->id) }}"
                                                    method="comment_reply">
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
                 {{ $comment_replies->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
 @endsection
