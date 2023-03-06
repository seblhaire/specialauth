<?php use \Seblhaire\Formsbootstrap\FormsBootstrapUtils; ?>
@extends('specialauth:private.layouts.layout')

@section('content')
<form id="reset" role="form" method="POST" class="form-signin" action="{{ route('password.update') }}">
@csrf
<input type="hidden" name="token" value="{{ $token }}"/>
<h1 class="h3 mb-3 font-weight-normal">{{ __('Reset Password') }}</h1>
<label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
<input type="email" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" name="email" required autofocus value="{{ old('email') }}"/ >
@if ($errors->has('email'))
    <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
@endif
{!! Form::bsPasswordWithConfirm([
    'show_old' => false,
    'newpass' => [
      'labelclass' => "sr-only",
      'attributes' =>  [
        'autocomplete' =>  "new-password",
        'placeholder' => FormsBootstrapUtils::translateOrPrint(config('formsbootstrap.defaults.password-with-confirm.newpass.labeltext'))
      ],
    ],
    'newpassclear' => [
      'attributes' =>  [
        'placeholder' => FormsBootstrapUtils::translateOrPrint(config('formsbootstrap.defaults.password-with-confirm.newpass.labeltext'))
      ],
    ],
    'confirmpass' => [
      'labelclass' => "sr-only",
      'attributes' =>  [
        'autocomplete' =>  "new-password",
        'placeholder' => FormsBootstrapUtils::translateOrPrint(config('formsbootstrap.defaults.password-with-confirm.confirmpass.labeltext'))
      ],
    ],
    'input_in_div' => false
  ]); !!}
  <button type="submit" class="btn btn-lg btn-primary btn-block">
      {{ __('Reset Password') }}
  </button>

  </form>
  <script type="text/javascript">
      jQuery('button[type=submit]').bind('click', function(e){
          e.preventDefault();
         // refreshToken();
          jQuery('#reset').submit();
      });
  </script>
@endsection
