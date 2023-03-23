@extends('specialauth::private.layouts.layout')

@section('content')
<form id="resetemail" role="form" method="POST" class="form-signin" action="{{ route('password.email') }}">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">{{ __('specialauth::messages.resetpass') }}</h1>
    @if (session('status'))resetpass
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <label for="email" class="sr-only">{{ __('specialauth::messages.emailaddr') }}</label>
    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('specialauth::messages.emailaddr') }}" value="{{ old('email') }}" name="email" required autofocus / >
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <br/>
    <button type="submit" class="btn btn-lg btn-primary btn-block">
        {{ __('specialauth::messages.sendpassreset') }}
    </button>
</form>
<script type="text/javascript">
    jQuery('button[type=submit]').bind('click', function(e){
        e.preventDefault();
       // refreshToken();
        jQuery('#resetemail').submit();
    });
</script>
@endsection
