<div class="nav-scroller py-1 mb-4">
    <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="/">Главная</a>
        <a class="p-2 text-muted" href="{{ route('news') }}">Новости</a>
        <a class="p-2 text-muted" href="{{ route('about') }}">О нас</a>
        <a class="p-2 text-muted" href="{{ route('contacts') }}">Контакты</a>
        @if (Auth::check())
            <a class="p-2 text-muted" href="{{ route('postCreate') }}">Создать статью</a>
            <a class="p-2 text-muted" href="{{ route('newsCreate') }}">Создать новость</a>
        @endif
        <a class="p-2 text-muted" href="{{ route('task') }}">Список задач</a>
        @can('view-admin-part')
            <a class="p-2 text-muted" href="{{ route('feedback') }}">Админ. раздел</a>
        @endcan
    </nav>
</div>
