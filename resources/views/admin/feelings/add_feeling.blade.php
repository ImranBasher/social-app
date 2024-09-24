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
            <h3 class="card-title">Add Feeling</h3>
        </div>

        @if ($errors->any())
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif 
        



        <form action="{{ route('feelings.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.feelings.feeling_form')
        </form>
    </div>

    @if($errors->any())
    <div class="card-footer text-body-secondary">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    </div>
    @endif 
@endsection








{{-- 

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header col-md-3">
                    <a href="{{ route('feelings.index') }}" class="btn btn-info"> Back</a>
                </div>

                <div class="card-body">

                    <h1 class="text-center ">Add Feeling</h1>

                    {{-- ----------- --}}
{{-- 
                    @if ($errors->any())
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach


                        <form action="{{ route('feelings.store') }}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                @foreach ($errors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @endif

                            {{-- @method('PUT'); --}}
                            {{-- @include('admin.feelings.feeling_form')
                        </form> --}} 

                        {{-- ---------- --}}

                {{-- </div>
            </div>
        </div>
    </div>
</div>


@endsection --}} 
