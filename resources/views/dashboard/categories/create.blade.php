@extends('layouts.dashboard.index')

@push('title')

<h1>@lang('site.create')</h1>

<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li><a href="{{ route('dashboard.categories.index')}}">{{ trans('site.categories')}}</a></li>
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
        <form action="{{route('dashboard.categories.store')}}" method="post">
            {{ csrf_field() }}

            @foreach (config('translatable.locales') as $locale )

                <div class="form-group">
                    {{-- site.ar.name --}}

                    <label> @lang('site.' . $locale . '.name') </label>

                    <input type="text" name="{{$locale}}[name]" class="form-control" value="{{ old($locale.'.name')}}">

                </div>


            @endforeach

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
            </div>
        </form>
    </div>
</div>
@endsection
