<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Firstname') }}</label>
            <input id="firstname" type="text" value="{{ old('firstname', $review->firstname) }}" name="firstname" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Lastname') }}</label>
            <input id="lastname" type="text" value="{{ old('lastname', $review->lastname) }}" name="lastname" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Product') }}</label>
            <input id="product" type="text" value="{{ old('product', $review->product) }}" name="product" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input id="email" type="text" value="{{ old('email', $review->email) }}" name="email" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Comment') }}</label><br/>
            <textarea name="message" class="form-control" {{ isset($isView)? "disabled" : '' }}>{{ old('message', $review->message) }}</textarea>
        </div>

        <div class="form-group">
            <label>{{ __('Status') }}</label>
            <select id="status" name="status" class="form-control" {{ isset($isView)? "disabled" : '' }}>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" 
                        @if($status == $review->status) selected="selected" @endif
                    >
                        {{ ucfirst(preg_replace('/_/', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>    
