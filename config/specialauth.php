<?php
return [
  'routeprefix' => 'admin',
  'logindest' => 'adminhome', // adminhome
  'logoutdest' => 'login',
  'resetpasswordfunc' => '', // App\Utils\Mails::sendResetNotification,
  'createpasswordfunc' => '', // App\Utils\Mails::sendCreatePasswordNotification,
  'roles' => [
    'administrator',
    'standard_user',
  ],
  'profile' => [
    //'table_max_element',
  ],
];
