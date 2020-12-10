<div class="categories-dropdown">
    <ul>
        @foreach($categories as $category)
            <li><a href="{{ route('categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>