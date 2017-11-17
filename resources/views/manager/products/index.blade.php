@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @lang('products.index.title')
                        <span class="pull-right"><a class="btn btn-sm btn-primary" href="{{ route('products.create') }}">@lang('products.index.add')</a></span>
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>@lang('products.index.name')</th>
                                <th>@lang('products.index.operations')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( ! $products->isEmpty())
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-success" href="#">@lang('products.index.edit')</a>
                                                <a class="btn btn-sm btn-danger" href="#">@lang('products.index.delete')</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">
                                        @lang('products.index.no-items')
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
