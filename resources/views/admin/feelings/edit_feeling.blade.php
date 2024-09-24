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
        

        <form action="{{ route('feelings.update', $feeling->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
@method('PUT')
            @include('admin.feelings.feeling_form')
        </form>
    </div>
@endsection