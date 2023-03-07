<?php
return [
  'routeprefix' => 'admin',
  'logindest' => 'adminhome', // adminhome
  'logoutdest' => 'login',
  'resetpasswordnotification' => 'Seblhaire\Specialauth\ResetPasswordNotification',
  'createpasswordnotification' => 'Seblhaire\Specialauth\CreatePasswordNotification',
  'roles' => [
    'administrator',
    'standard_user',
  ],
  'profile' => [
    //'table_max_element',
  ],
];
