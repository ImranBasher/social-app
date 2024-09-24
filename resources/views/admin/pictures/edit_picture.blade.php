


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


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Picture </h3>
        </div>

        {{-- ----------- --}}

        @if ($errors->any())
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
            @endif @if ($errors->any())
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endif

            <form action="{{ route('pictures.edit', $picture->id) }}" class="form-horizontal" method="POST"
                enctype="multipart/form-data">
              @csrf

          @if ($errors->any())
              @foreach ($errors as $error )
                  <li>{{ $error }}</li>
              @endforeach
          @endif

              {{-- @method('PUT'); --}}
              @include("admin.pictures.picture_form")
          </form>

            {{-- ---------- --}}
            </form>
    </div>
@endsection
