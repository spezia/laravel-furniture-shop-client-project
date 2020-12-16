<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="product">{{ __('Product') }}</label>
            <select id="product" name="product_id" class="form-control" {{ isset($isView)? "disabled" : '' }}>
                <option value="">--</option>
                @if($products->count() > 0)
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" 
                            @if((old('product_id') && $product->id == old('product_id')) || ($discount && $product->id == $discount->product->id)) selected="selected" @endif
                        >
                        
                            {{ $product->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('Discount Price') }}</label>
            <input id="new_price" type="text" value="{{ $discount? old('new_price', $discount->new_price) : old('new_price') }}" 
                name="new_price" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        @if(isset($isView) || $discount)
            <div class="form-group">
                <label>{{ __('Original Product Price') }}</label>
                <input type="text" value="{{ $discount->product->price }}"  class="form-control" disabled>
            </div>
            <div class="form-group">
                <label>{{ __('Discount in Percentage') }}</label>
                <input type="text" value="{{ $discount->discount }}"  class="form-control" disabled>
            </div>
        @endif

        <div class="form-group">
            <label>{{ __('Discount From') }}</label>
            <input id="from" type="text" value="{{ $discount? old('from', $discount->from->format('d.m.Y')) : old('from') }}" 
                name="from" class="date form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>

        <div class="form-group">
            <label>{{ __('Discount To') }}</label>
            <input id="to" type="text" value="{{ $discount? old('to', $discount->to->format('d.m.Y')) : old('to') }}" 
                name="to" class="date form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
    </div>
</div>
