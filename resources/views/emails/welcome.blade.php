@component('mail::message')
    # Thông tin ca làm việc

    {{$order}}

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
