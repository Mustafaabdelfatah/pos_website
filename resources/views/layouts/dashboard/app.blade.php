@extends('layouts.dashboard.index')
@push('title')
 <h1>@lang('site.dashboard')</h1>
 <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
</ol>
@endpush
@section('content')

<h1> this is dashboard</h1>

@endsection

