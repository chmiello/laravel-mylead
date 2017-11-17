

<div class="panel-body">
    {{ csrf_field() }}
    <div class="form-group @if($errors->has('name')) has-error @endif">
        <label for="product-name">@lang('products.create.label.name')</label>
        <input class="form-control" value="{{ old('name', $product->name) }}" type="text" name="name" id="product-name"/>
        @if($errors->has('name'))
            <div class="help-block">
                @lang('products.crete.error.field.required')
            </div>
        @endif
    </div>

    <div class="form-group @if($errors->has('description')) has-error @endif">
        <label for="product-description">@lang('products.create.label.description')</label>
        <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        @if($errors->has('description'))
            <div class="help-block">
                @lang('products.crete.error.field.required')
            </div>
        @endif
    </div>

    @if($errors->has('prices.*.label') || $errors->has('prices.*.price'))
        <div class="form-group has-error">
            <div class="help-block">@lang('products.crete.error.prices-description.required')</div>
        </div>
    @elseif($errors->has('prices.*.selected'))
        <div class="form-group has-error">
            <div class="help-block">@lang('products.crete.error.active-price.required')</div>
        </div>
    @endif

    <prices :items="{{ collect(old('prices', $product->prices))}}"></prices>
</div>