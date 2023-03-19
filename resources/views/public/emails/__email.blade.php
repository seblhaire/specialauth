@extends('specialauth::private.emails.layout')

@section('footer')
<a href="{{ env('APP_URL')}}">
  <img src="logo.png" />
</a>
@endsection
@section('content')

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
@include('specialauth::private.emails.button')
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
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser:",
    [
        'actionText' => $actionText,
    ]
) <span class="break-all"><a href="{{ $actionUrl }}">{{ $displayableActionUrl }}</a></span>
@endisset
@endsection
@section('footer')
Fooooter
@endsection
