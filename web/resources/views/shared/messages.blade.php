@if ($errors->any() || session('message') || session('error'))
    <div class="col-md-12">
        <div class="alert @if(session('message')) alert-success @else alert-danger @endif margin-top20 no-borders">
            @if (session('message'))
                {{ session('message') }}
            @elseif (session('error'))
                {{ session('error') }}
            @endif
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endif
