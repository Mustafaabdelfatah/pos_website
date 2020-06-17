@extends('layouts.dashboard.index')

@push('title')

<h1>@lang('site.create')</h1>

<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li><a href="{{ route('dashboard.clients.index')}}">{{ trans('site.clients')}}</a></li>
    <li class="active">{{ trans('site.add')}}</li>
</ol>

@endpush

@section('content')

<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">@lang('site.add')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="{{route('dashboard.clients.store')}}" method="post">
            {{ csrf_field() }}


            <div class="form-group">
                <label> @lang('site.name')</label>
                <input type="text" name="name" class="form-control" value="{{old('value')}}">
            </div>

            @for ($i =0 ; $i < 2; $i++)
                <div class="form-group">
                    <label> @lang('site.phone')</label>
                    <input type="text" name="phone[]" class="form-control">
                </div>
            @endfor


            <div class="form-group">
                <label> @lang('site.address')</label>
                <textarea name="address" class="form-control" value="{{old('value')}}"></textarea>
            </div>




            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
            </div>
        </form>
    </div>
</div>
@endsection
