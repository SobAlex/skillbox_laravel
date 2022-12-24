@component('mail::message')


    @component('mail::button', ['url' => $scv])
        скачать отчет
    @endcomponent


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
