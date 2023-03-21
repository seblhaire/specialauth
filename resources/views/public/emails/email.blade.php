<x-specialauth::layout>
{{-- Header --}}
<x-slot:header>
<x-specialauth::header :url="config('app.url')">
<img src="{{ asset('/img/logo.png')}}"/>
</x-specialauth::header>
</x-slot:header>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-specialauth::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-specialauth::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif
{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
{{-- Footer --}}
<x-slot:footer>
<x-specialauth::footer>
My footer
</x-specialauth::footer>
</x-slot:footer>
</x-specialauth::layout>
