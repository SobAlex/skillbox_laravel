@if (session()->has('message'))
    <div class="alert alert-{{ Session::get('class') }} mt-4">
        {{ session('message') }}
    </div>
@endif
