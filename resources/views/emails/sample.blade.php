@component('mail::message')
{{ $message }}

@component('mail::button', ['url' => $url])
{{ $button_label }}
@endcomponent

Avec nos salutations,

@endcomponent
