<div class="categories-dropdown">
    <ul>
        @foreach($categories as $category)
            <li><a href="{{ route('categories.front.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</div>