<?php
return [
  'routeprefix' => '',
  'logindest' => '', //'adminhome'
  'resetpasswordfunc' => '', // App\Utils\Mails::sendResetNotification,
  'createpasswordfunc' => '', // App\Utils\Mails::sendCreatePasswordNotification,
  'roles' => [
    'administrator',
    'contributor',
  ],
  'profile' => [
    'table_max_element',
  ],
]
