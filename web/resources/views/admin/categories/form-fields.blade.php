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
                    <label for="name">{{ __('Name') }}</label>
                    <input id="{{ $locale }}-name" type="text" class="form-control" name="name[{{ $locale }}]" value="{{ $category? old('name.'.$locale, $category->getTranslation('name', $locale)) : old('name.'.$locale) }}" {{ isset($isView)? "disabled" : '' }}/>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea id="{{ $locale }}-description" type="text" class="form-control" name="description[{{ $locale }}]" {{ isset($isView)? "disabled" : '' }}>{{ $category? old('description.'.$locale, $category->getTranslation('description', $locale)) : old('description.'.$locale) }}</textarea>
                </div>
            </div>
        @endforeach    
        </div>
         <div class="form-group">
             <label>{{ __('Status') }}</label></br>
             <input id="is-enabled" type="checkbox" value="1" name="is_enabled" class="minimal"
                 {{ $category && 1 == old('is_enabled', $category->is_enabled)? 'checked' : '' }} 
                 {{ isset($isView)? "disabled" : '' }}>
             </label>
             <label class="text-weight500">{{ __('Is enabled') }}</label>
         </div>
    </div>
</div>    
