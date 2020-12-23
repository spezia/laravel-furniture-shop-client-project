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
                    <input id="{{ $locale }}-name" type="text" class="form-control" name="name[{{ $locale }}]" value="{{ $product? old('name.'.$locale, $product->getTranslation('name', $locale)) : old('name.'.$locale) }}" {{ isset($isView)? "disabled" : '' }}/>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea id="{{ $locale }}-description" class="form-control" name="description[{{ $locale }}]" {{ isset($isView)? "disabled" : '' }}>{{ $product? old('description.'.$locale, $product->getTranslation('description', $locale)) : old('description.'.$locale) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">{{ __('Properties') }}</label>
                    <small>
                        <br/>Use comma to separate values. Ex: height: 180, weight: 120, length:50</br> 
                    </small>
                    <textarea id="{{ $locale }}-properties" class="form-control" name="properties[{{ $locale }}]" {{ isset($isView)? "disabled" : '' }}>{{ $product? old('properties.'.$locale, $product->getTranslation('properties', $locale)) : old('properties'.$locale) }}</textarea>
                </div>
            </div>
        @endforeach    
        </div>

        <div class="form-group">
            <label>{{ __('Category') }}</label>
            <select id="category" name="category" class="form-control" {{ isset($isView)? "disabled" : '' }}>
                <option value="">--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if((old('category') && $category->id == old('category')) || ($product && $category->id == $product->category->id)) selected="selected" @endif
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>{{ __('Code') }}</label>
            <input id="code" type="text" value="{{ $product? old('code', $product->code) : old('code') }}" name="code" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>
        <div class="form-group">
            <label>{{ __('Price') }}</label>
            <input id="price" type="text" value="{{ $product? old('price', $product->price) : old('price') }}" name="price" class="form-control" {{ isset($isView)? "disabled" : '' }}>
        </div>

        @if(!isset($isView))
            <div class="form-group">
                <label>{{ __('Images') }}</label>
                @if($product)
                    @foreach ($product->getMedia($collection) as $key => $image)
                        <div class="position-relative margin-top20 row">
                            <div class="col-2">
                                <label>{{ __('image') }}</label>
                            </div>
                            <div class="col-3">
                                <a href="{{ $image->getUrl() }}" data-toggle="lightbox">
                                    <img src="{{ $image->getUrl('thumb') }}" class="img-fluid img-circle">
                                </a>
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-entity"
                                    data-url="{{ route('products.remove.image', ['product' => $product->id, 'image' => $image->id]) }}" >
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="position-relative margin-top20 row">
                        <div class="col-9">
                            <label>{{ __('image ') }} <small>(max size 2 MB)</small></label>
                            <input type="file" name="images[]" class="minimal"/>
                        </div>
                    </div>
                @endif
               <div id="moreFields"></div>
               <div class="box-footer text-right position-relative margin-top20">
                   <button id="addMoreItems" href="#" type="button" class="btn btn-primary btn-sm width100">
                     <i class="fa fa-fw fa-plus"></i>
                     {{ __('Add more') }}
                   </button>
               </div>
            </div>
        @else  
            @foreach ($product->getMedia($collection) as $key => $image)
                <div class="position-relative margin-top20 row">
                    <div class="col-2">
                        <label>{{ __('image') }}</label>
                    </div>
                    <div class="col-3">
                        <a href="{{ $image->getUrl() }}" data-toggle="lightbox">
                            <img src="{{ $image->getUrl('thumb') }}" class="img-fluid img-circle">
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="form-group">
            <label>{{ __('Status') }}</label></br>
            <input id="is-enabled" type="checkbox" value="1" name="is_enabled" class="minimal"
                {{ $product && 1 == old('is_enabled', $product->is_enabled)? 'checked' : '' }} 
                {{ isset($isView)? "disabled" : '' }}>
            </label>
            <label class="text-weight500">{{ __('Is enabled') }}</label>
        </div>
    </div>
</div>    
