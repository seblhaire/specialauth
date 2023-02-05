@extends('specialauth::layouts.layout')

@section('content')
<form id="resetemail" role="form" method="POST" class="form-signin" action="{{ route('password.email') }}">
    @csrf
    <h1 class="h3 mb-3 font-weight-normal">{{ __('Reset Password') }}</h1>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" name="email" required autofocus / >
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderrorso
    <br/>
    <button type="submit" class="btn btn-lg btn-primary btn-block">
        {{ __('Send Password Reset Link') }}
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
