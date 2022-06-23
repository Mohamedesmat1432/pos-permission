@extends('layouts.dashboard.app')


@section('content')
    <div class="container-fluid">
        <div class="content-header row py-2">
            <div class="col-sm-6">
                <h1>{{ __('create' . ' ' . __('user')) }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
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
                        <form action="{{ route('dashboard.users.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label>{{ __('site.email') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('site.password') }}</label>
                                        <input type="password" class="form-control" name="password" />
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('site.password_confirmation') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation" />
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('site.image') }}</label>
                                <input type="file" class="form-control image" name="image"/>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <img src="{{asset('uploads/users/default.png')}}" class="img-thumbnail rounded m-2" width="60" id="imageUpload" alt="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('site.permissions') }}</label>
                                <!-- ./row -->
                                @php
                                    $models = ['users', 'categories', 'products'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                @endphp
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card  card-outline card-info card-tabs">
                                            <div class="card-header p-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    @foreach ($models as $index => $model)
                                                        <li class="nav-item">
                                                            <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                                id="custom-tabs-one-home-tab" data-toggle="pill"
                                                                href="#{{ $model }}" role="tab"
                                                                aria-controls="custom-tabs-one-home"
                                                                aria-selected="true">{{ __('site.' . $model) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                                    @foreach ($models as $index => $model)
                                                        <div class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}"
                                                            id="{{ $model }}" role="tabpanel"
                                                            aria-labelledby="custom-tabs-one-home-tab">
                                                            @foreach ($maps as $map)
                                                                <label class="mx-2">
                                                                    <input type="checkbox" name="permissions[]"
                                                                        value="{{ $model . '_' . $map }}" />
                                                                    {{ __('site.' . $map) }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                    @error('permissions')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
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
