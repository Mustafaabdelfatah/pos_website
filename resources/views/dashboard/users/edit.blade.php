@extends('layouts.dashboard.index')

@push('title')

<h1>@lang('site.edit')</h1>

<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li><a href="{{ route('dashboard.users.index')}}">{{ trans('site.users')}}</a></li>
    <li class="active">{{ trans('site.edit')}}</li>
</ol>

@endpush

@section('content')

<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">@lang('site.edit')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="{{route('dashboard.users.update',$users->id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            {{ method_field('put')}}
            <div class="form-group">
                <label> @lang('site.first_name') </label>
                <input type="text" name="first_name" class="form-control" value="{{$users->first_name}}">
            </div>

            <div class="form-group">
                <label> @lang('site.last_name') </label>
                <input type="text" name="last_name" class="form-control" value="{{$users->last_name}}">
            </div>

            <div class="form-group">
                <label> @lang('site.email') </label>
                <input type="email" name="email" class="form-control" value="{{$users->email}}">
            </div>

            <div class="form-group">
                <label> @lang('site.image') </label>
                <input type="file" name="image" class="form-control image">
            </div>

            <div class="form-group">
                <img src="{{ $users->image_path }}" class="img-thumbnail image-preview" style="width:100px">
            </div>

           <div class="form-group">

                <label>@lang('site.permissions')</label>

                <div class="nav-tabs-custom">

                    @php
                        $models=['users','categories','product','clients','orders'];
                        $maps=['create','read','update','delete'];
                    @endphp

                    <ul class="nav nav-tabs">
                        @foreach ($models as $index=>$model )
                            <li class="{{ $index == 0 ? 'active': '' }}"><a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($models as $index=>$model )
                            <div class="tab-pane {{ $index == 0 ? 'active': '' }}" id="{{$model}}">

                            @foreach ($maps as $map )
                                <label><input type="checkbox" name="permissions[]" {{ $users->hasPermission($map . '_' . $model) ? 'checked':'' }} value="{{ $map . '_' . $model}}">@lang('site.'.$map)</label>
                            @endforeach
                        </div>
                        @endforeach
                    </div><!-- end of tab-content -->

                </div><!-- end of nav-tabs custom -->

            </div><!-- end of form group -->


            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
            </div>
        </form>
    </div>
</div>
@endsection
