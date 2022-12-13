@component('mail::message')


    @component('mail::button', ['url' => 'ссылка на файл'])
        скачать отчет
    @endcomponent


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
