@php
    $tags = $tags ?? collect();
@endphp

@if ($tags->isNotEmpty())

    <div>
        @foreach ($tags as $tag)
            <a href="/posts/tags/{{ $tag->getRouteKey() }}" class="badge badge-info">{{ $tag->name }}</a>
        @endforeach
    </div>

@endif
