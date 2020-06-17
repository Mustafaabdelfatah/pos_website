@extends('layouts.dashboard.index')

@push('title')
<h1>@lang('site.clients')</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li class="active">{{ trans('site.clients')}}</li>
</ol>
@endpush
@section('content')



<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title">@lang('site.clients') <small style="color:#3c8dbc"> {{ $clients->total()}} </small></h3>

        <span style="height:20px;display:block"></span>

        <form action="{{route('dashboard.clients.index')}}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                        @lang('site.search')</button>

                    @if (auth()->user()->hasPermission('create_clients'))
                        <a href="{{ route('dashboard.clients.create')}}" class="btn btn-info"><i class="fa fa-plus"></i>
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

        @if($clients->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.phone')</th>
                    <th>@lang('site.address')</th>
                    <th>@lang('site.add_order')</th>
                    <th>@lang('site.action')</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($clients as $client )
                <tr>
                    <td>
                        {{ $client->id }}
                    </td>
                    <td>
                        {{ $client->name }}
                    </td>

                    <td>
                        {{ is_array($client->phone) ? implode($client->phone , '-') : $client->phone }}
                    </td>
                    <td>
                        {{ $client->address }}
                    </td>
                     <td>
                     @if (auth()->user()->hasPermission('create_orders'))
                        <a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-primary">@lang('site.add_order')</a>
                        @else
                         <a href="#" class="btn btn-primary" disabled>@lang('site.add_order')</a>

                     @endif
                    </td>

                    <td>

                        <a href="{{ route('dashboard.clients.edit', $client->id)}}"
                            class="btn btn-info btn-sm">@lang('site.edit')</a>


                        <form action="{{ route('dashboard.clients.destroy',$client->id)}}" method="post"
                            style="display:inline-block">
                            {{ csrf_field() }}
                            {{ method_field("delete")}}
                            <button type="submit" class="btn btn-danger delete btn-sm">@lang('site.delete')</button>
                        </form>



                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- end of table -->

        {{ $clients->appends(request()->query())->links() }}

        @else
        <h2>@lang('site.no_data_found')</h2>
        @endif

    </div><!-- end of box body -->
</div>

@endsection
