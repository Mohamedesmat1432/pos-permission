@extends('layouts.dashboard.app')


@section('content')
    <div class="container-fluid">
        <div class="content-header row py-2">
            <div class="col-sm-6">
                <h1>{{ __('create' . ' ' . __('category')) }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">categories</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    {{-- <div class="card-header">
                        <h3 class="card-title">
                            create user
                        </h3>
                    </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('dashboard.categories.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label>{{ __('site.name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i
                                        class="fa fa-plus"></i>{{ __('site.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div><!-- /.container-fluid -->
@endsection
