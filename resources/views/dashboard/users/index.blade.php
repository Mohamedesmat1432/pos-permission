@extends('layouts.dashboard.app')

@section('content')
    <div class="container-fluid">
        <div class="content-header row py-2">
            <div class="col-sm-6">
                <h1>{{__('site.users')}} {{__('site.table')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">{{__('site.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('site.users')}}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{route('dashboard.users.index')}}" method="GET" style="display: inline">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control form-control" value="{{request()->search}}" placeholder="{{__('site.search')}}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                @if (auth()->user()->hasPermission('users_create'))
                                    <a href="{{route('dashboard.users.create')}}" class="btn btn-info float-right"><i class="fa fa-plus"></i>{{__('site.add')}}</a>
                                @else
                                    <a href="#" class="btn btn-info float-right disabled"><i class="fa fa-plus"></i>{{__('site.add')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($users->count() > 0)
                            <table class="table table-bordered table-striped text-center table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>image</th>
                                        <th colspan="2">action</th>
                                        {{-- <th style="width: 40px">Label</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index=>$user)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <img src="{{ $user->image_path }}" class="rounded-circle" width="60" alt=""/>
                                            </td>
                                            <td>
                                                @if (auth()->user()->hasPermission('users_update'))
                                                    <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('site.edit')}}</a>
                                                @else
                                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>{{__('site.edit')}}</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (auth()->user()->hasPermission('users_delete'))
                                                    <form action="{{route('dashboard.users.destroy',$user->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل انت متأكد من حذف هذا المشرف ؟') ; event.perventDefault();"><i class="fa fa-trash"></i>{{__('site.delete')}}</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>{{__('site.delete')}}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{$users->appends(request()->query())->links()}}
                            </div>
                        @else
                            <h3>{{__('site.no_data_founded')}}</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
