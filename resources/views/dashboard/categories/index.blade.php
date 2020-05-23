@extends('layouts.dashboard.index')

@push('title')
<h1>@lang('site.categories')</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li class="active">{{ trans('site.categories')}}</li>
</ol>
@endpush
@section('content')



<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title">@lang('site.categories') <small style="color:#3c8dbc"> {{ $categories->total()}} </small></h3>

        <span style="height:20px;display:block"></span>

        <form action="{{route('dashboard.categories.index')}}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('site.search')">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                        @lang('site.search')</button>

                    @if (auth()->user()->hasPermission('create_categories'))
                        <a href="{{ route('dashboard.categories.create')}}" class="btn btn-info"><i class="fa fa-plus"></i>
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

        @if($categories->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('site.name')</th>
                    <th>@lang('site.products_count')</th>
                    <th>@lang('site.related_product')</th>
                    <th>@lang('site.action')</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category )
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        {{ $category->name }}
                    </td>

                    <td>
                        {{ $category->products->count() }}
                    </td>

                    <td>
                        <a href="{{}}"></a>
                    </td>


                    <td>

                        <a href="{{ route('dashboard.categories.edit', $category->id)}}"
                            class="btn btn-info btn-sm">@lang('site.edit')</a>


                        <form action="{{ route('dashboard.categories.destroy',$category->id)}}" method="post"
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

        {{ $categories->appends(request()->query())->links() }}

        @else
        <h2>@lang('site.no_data_found')</h2>
        @endif

    </div><!-- end of box body -->
</div>

@endsection
