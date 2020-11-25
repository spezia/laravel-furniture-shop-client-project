<div class="row">
    <div class="col-md-6">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach (config('app.locales') as $locale)
                <li class="nav-item">
                    <a class="nav-link {{ $locale == 'en'? 'active' : '' }}" id="{{ $locale }}-tab" data-toggle="tab" href="#{{ $locale }}" role="tab" aria-controls="{{ $locale }}" aria-selected="{{ $locale == 'en'? 'true' : 'false' }}">{{ $locale }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
        @foreach (config('app.locales') as $locale)  
            <div class="tab-pane fade  {{ $locale == 'en'? 'show active' : '' }} orm-group" id="{{ $locale }}" role="tabpanel" aria-labelledby="{{ $locale }}-tab">
                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input id="{{ $locale }}-title" type="text" class="form-control" name="title[{{ $locale }}]" value="{{ $page? old('title.'.$locale, $page->getTranslation('title', $locale)) : old('title.'.$locale) }}" {{ isset($isView)? "disabled" : '' }}/>
                </div>
                <div class="form-group">
                    <label for="content">{{ __('Content') }}</label>
                    <textarea id="{{ $locale }}-content" type="text" class="form-control" name="content[{{ $locale }}]" {{ isset($isView)? "disabled" : '' }}>{{ $page? old('content.'.$locale, $page->getTranslation('content', $locale)) : old('content.'.$locale) }}</textarea>
                </div>
            </div>
        @endforeach    
        </div>
        <div class="form-group">
            <label>{{ __('Status') }}</label></br>
            <input id="is-enabled" type="checkbox" value="1" name="is_enabled" class="minimal"
                {{ $page && 1 == old('is_enabled', $page->is_enabled)? 'checked' : '' }} 
                {{ isset($isView)? "disabled" : '' }}>
            </label>
            <label class="text-weight500">{{ __('Is enabled') }}</label>
        </div>
    </div>
</div>    
