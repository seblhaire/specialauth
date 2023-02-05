@component('mail::message')
{{ $message }}

@component('mail::button', ['url' => $url])
{{ $button_label }}
@endcomponent

Greetings

@endcomponent
