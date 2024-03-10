<?php

return [
    'routeprefix' => 'admin',
    'logindest' => 'adminhome', // adminhome
    'logoutdest' => 'login',
    'resetpasswordnotification' => 'Seblhaire\Specialauth\Notifications\ResetPasswordNotification',
    'createpasswordnotification' => 'Seblhaire\Specialauth\Notifications\CreatePasswordNotification',
    'roles' => [
        'administrator',
        'standard_user',
    ],
    'profile' => [
    //'table_max_element',
    ],
];
