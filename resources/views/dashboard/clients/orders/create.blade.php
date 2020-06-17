@extends('layouts.dashboard.index')

@push('title')

<h1>@lang('site.add_order')</h1>

<ol class="breadcrumb">
    <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i>{{ trans('site.dashboard')}}</a></li>
    <li><a href="{{ route('dashboard.clients.index')}}">{{ trans('site.clients')}}</a></li>
    <li class="active">{{ trans('site.add_order')}}</li>
</ol>

@endpush

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.categories')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @foreach ($categories as $category )
                        <div class="panel-group">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#{{str_replace(' ','-',$category->name)}}">{{$category->name}}</a>
                                    </h4>
                                </div>
                                <div id="{{str_replace(' ','-',$category->name)}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        @if($category->products->count()>0)
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.stock')</th>
                                                    <th>@lang('site.price')</th>
                                                    <th>@lang('site.add')</th>
                                                </tr>

                                                @foreach ($category->products as $product )
                                                    <tr>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{$product->stock}}</td>
                                                        <td>{{$product->sale_price}}</td>
                                                        <td>
                                                            <a
                                                            href=""
                                                            id="product-{{$product->id}}"
                                                            data-name="{{$product->name}}"
                                                            data-id="{{$product->id}}"
                                                            data-price={{$product->sale_price}}
                                                            class="btn btn-success btn-sm add-product-btn">
                                                            <i class="fa fa-plus"></i>

                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.orders')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('site.products')</th>
                                <th>@lang('site.quantity')</th>
                                <th>@lang('site.price')</th>
                            </tr>
                        </thead>
                         <tbody>
                        </tbody>
                    </table><!-- end of table -->
                </div>
            </div>
        </div>
    </div>
@endsection
