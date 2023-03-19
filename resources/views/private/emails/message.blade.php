<x-specialauth::private.emails.layout>
{{-- Header --}}
<x-slot:header>
<x-specialauth::private.emails.header :url="config('app.url')">
{{ config('app.name') }}
</x-specialauth::private.emails.header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-specialauth::private.emails.subcopy>
{{ $subcopy }}
</x-specialauth::private.emails.subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-specialauth::private.emails.footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-specialauth::private.emails.footer>
</x-slot:footer>
</x-specialauth::private.emails.layout>
