@extends('specialauth::private.layouts.layout')

@section('content')
<form id="login" role="form" method="POST" class="form-signin" action="{{ route('login') }}">
  {{ csrf_field() }}
  <h1 class="h3 mb-3 font-weight-normal">{{ __('specialauth::message.login') }}</h1>
  <label for="email" class="sr-only">{{ __('specialauth::messages.emailaddr') }}</label>
  <input type="email" id="email" class="form-control" placeholder="{{ __('specialauth::messages.emailaddr') }}" name="email" required autofocus value="{{ old('email') }}"/ >
  @if ($errors->has('email'))
      <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
  <label for="password" class="sr-only">{{ __('specialauth::message.password') }}</label>
  <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('specialauth::message.password') }}" required>
  @if ($errors->has('password'))
      <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
      </span>
  @endif
  <div class="checkbox mb-3">
    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('specialauth::message.rememberme') }}
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('specialauth::message.login') }}</button>
  <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('specialauth::message.forgotpass') }}</a>
</form>
<script type="text/javascript">
    jQuery('button[type=submit]').bind('click', function(e){
        e.preventDefault();
        jQuery('#login').submit();
    });
</script>
@endsection
