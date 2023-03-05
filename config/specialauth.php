<?php
return [
  'routeprefix' => 'admin',
  'logindest' => 'adminhome', // adminhome
  'logoutdest' => 'login',
  'resetpasswordnotification' => '', // App\ResetPasswordNotification::class,
  'createpasswordnotification' => '', // App\CreatePasswordNotification::class
  'roles' => [
    'administrator',
    'standard_user',
  ],
  'profile' => [
    //'table_max_element',
  ],
];
