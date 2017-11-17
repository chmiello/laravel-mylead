@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <form action="{{ route('products.store') }}" method="post">
                        <div class="panel-heading">
                            @lang('products.create.title')
                            <span class="pull-right"><a class="btn btn-sm btn-primary" href="{{ route('products.list') }}">@lang('products.create.back')</a></span>
                        </div>

                        <div class="panel-body">
                            {{ csrf_field() }}
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label for="product-name">@lang('products.create.label.name')</label>
                                <input class="form-control" value="{{ old('name') }}" type="text" name="name" id="product-name"/>
                                @if($errors->has('name'))
                                    <div class="help-block">
                                        @lang('products.crete.error.field.required')
                                    </div>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <label for="product-description">@lang('products.create.label.description')</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <div class="help-block">
                                        @lang('products.crete.error.field.required')
                                    </div>
                                @endif
                            </div>

                            @if($errors->has('prices.*.description') || $errors->has('prices.*.value'))
                                <div class="form-group has-error">
                                    <div class="help-block">@lang('products.crete.error.prices-description.required')</div>
                                </div>
                            @elseif($errors->has('currentprice'))
                                <div class="form-group has-error">
                                    <div class="help-block">@lang('products.crete.error.active-price.required')</div>
                                </div>
                            @endif

                            <prices :items="{{ collect(old('prices'))}}"></prices>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">@lang('products.create.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
