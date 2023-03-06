@extends('specialauth::private.layouts.layout')

@section('content')
<form id="login" role="form" method="POST" class="form-signin" action="{{ route('login') }}">
  {{ csrf_field() }}
  <h1 class="h3 mb-3 font-weight-normal">{{ __('Login') }}</h1>
  <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
  <input type="email" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" name="email" required autofocus value="{{ old('email') }}"/ >
  @if ($errors->has('email'))
      <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
  <label for="password" class="sr-only">{{ __('Password') }}</label>
  <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>
  @if ($errors->has('password'))
      <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
      </span>
  @endif
  <div class="checkbox mb-3">
    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
  <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
</form>
<script type="text/javascript">
    jQuery('button[type=submit]').bind('click', function(e){
        e.preventDefault();
        jQuery('#login').submit();
    });
</script>
@endsection
