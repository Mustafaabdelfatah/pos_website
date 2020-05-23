@extends('layouts.dashboard.index')

@push('title')

<h1>@lang('site.users')</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li class="active">{{ trans('site.users')}}</li>
</ol>
@endpush

@section('content')

<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title"> @lang('site.users') <small style="color:#3c8dbc"> {{ $users->total()}} </small></h3>

        <span style="height:20px;display:block"></span>

        <form action="{{route('dashboard.users.index')}}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                        @lang('site.search')
                    </button>

                    @if (auth()->user()->hasPermission('create_users'))
                        <a href="{{ route('dashboard.users.create')}}" class="btn btn-info"><i class="fa fa-plus"></i>
                        @lang('site.add')</a>
                        @else
                        <a href="#" class="btn btn-info  disabled"><i class="fa fa-plus"></i>
                        @lang('site.add')</a>
                    @endif
                </div>
            </div>

        </form><!-- end of form -->
    </div>
    <!-- /.box-header -->

    <!-- box body -->
    <div class="box-body">

        @if($users->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('site.first_name')</th>
                    <th>@lang('site.last_name')</th>
                    <th>@lang('site.email')</th>
                     <th>@lang('site.image')</th>
                    <th>@lang('site.action')</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user )
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->first_name}}
                    </td>
                    <td>
                        {{ $user->last_name}}
                    </td>

                    <td>
                        {{ $user->email}}
                    </td>
                    <td>
                        <img src="{{ $user->image_path }}" style="width:100px" class="img-thumbnail">
                    </td>
                    <td>
                        @if (auth()->user()->hasPermission('update_users'))
                        <a href="{{ route('dashboard.users.edit', $user->id)}}"
                            class="btn btn-info btn-sm">@lang('site.edit')</a>
                        @else
                        <a href="#" class="btn btn-info btn-sm disabled">@lang('site.edit')</a>
                        @endif
                        @if (auth()->user()->hasPermission('delete_users'))
                        <form action="{{ route('dashboard.users.destroy',$user->id)}}" method="post"
                            style="display:inline-block">
                            {{ csrf_field() }}
                            {{ method_field("delete")}}
                            <button type="submit" class="btn btn-danger delete btn-sm">@lang('site.delete')</button>
                        </form>
                        @else
                        <button class="btn btn-danger disabled">@lang('site.delete')</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- end of table -->

        {{ $users->appends(request()->query())->links() }}

        @else
        <h2>@lang('site.no_data_found')</h2>
        @endif

    </div><!-- end of box body -->
</div>

@endsection
