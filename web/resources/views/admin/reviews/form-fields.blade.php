<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Name') }}</label>
            <input id="name" type="text" value="{{ old('name', $review->name) }}" name="name" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input id="email" type="text" value="{{ old('email', $review->email) }}" name="email" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Comment') }}</label><br/>
            <textarea name="comment" class="form-control" {{ isset($isView)? "disabled" : '' }}>{{ old('comment', $review->comment) }}</textarea>
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
