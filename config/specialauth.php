<?php
return [
  'routeprefix' => '',
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
