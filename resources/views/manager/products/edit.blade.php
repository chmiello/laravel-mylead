@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <form action="{{ route('products.store', ['product_id' => $product->id]) }}" method="post">
                        <div class="panel-heading">
                            @lang('products.edit.title')
                            <span class="pull-right"><a class="btn btn-sm btn-primary" href="{{ route('products.list') }}">@lang('products.create.back')</a></span>
                        </div>

                        @component('manager.products.form', compact('product'))

                        @endcomponent

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">@lang('products.update.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
