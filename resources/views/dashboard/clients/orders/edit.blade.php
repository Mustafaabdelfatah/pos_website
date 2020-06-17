@extends('layouts.dashboard.index')

@push('title')

<h1>@lang('site.edit')</h1>

<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li><a href="{{ route('dashboard.clients.index')}}">{{ trans('site.clients')}}</a></li>
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
        <form action="{{route('dashboard.clients.update',$client->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('put')}}


            <div class="form-group">
                <label> @lang('site.name')</label>
                <input type="text" name="name" class="form-control" value="{{ $client->name}}">
            </div>

            @for ($i =0 ; $i < 2; $i++)
                <div class="form-group">
                    <label> @lang('site.phone')</label>
                    <input type="text" name="phone[]" value="{{$client->phone[$i] ?? ''}}" class="form-control">
                </div>
            @endfor


            <div class="form-group">
                <label> @lang('site.address')</label>
                <textarea name="address" class="form-control">{{ $client->name}}</textarea>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
            </div>
        </form>
    </div>
</div>
@endsection
