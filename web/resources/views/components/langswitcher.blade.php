<div class="language">
    <div class="chosen-lang">
        @foreach (config('app.locales') as $locale)
            @if (app()->getLocale() == $locale)
                <input type="text" name="selected-language" readonly="readonly" class="active-language" value=" {{ strtoupper($locale) }}" />
            @endif
        @endforeach
        <img src="{{ asset('img/home/arrow-black.png') }}" />
    </div>
    <div class="language-list">
        @foreach (config('app.locales') as $locale)
            <div class="language-option">
                {{-- <a class="nav-link" href="{{ route('pages.front.home', ['newLocale' => $locale]) }}"  --}}
                <a class="nav-link" href="{{ route('locale.setting', $locale) }}" 
                    @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>
                    {{ strtoupper($locale) }}
                </a>
            </div>
        @endforeach
    </div>
</div>