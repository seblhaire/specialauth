# Specialauth

[By Sébastien L'haire](http://sebastien.lhaire.org)

This library is based on Laravel authentication libraries (login, logout, password reset procedure) but does not contain registration process.
Instead, application accounts are created by users with administrator rights.

# Installation

1. `composer require seblhaire/specialauth`
2. Composer will automatically link the package with Laravel. But you still can explicitely add provider and facade to your `config/app.php`:
```php
'providers' => [
    Seblhaire\Specialauth\SpecialauthServiceProvider::class,
    Seblhaire\Specialauth\PasswordResetServiceProvider::class
]
```
3. Publish package: `php artisan vendor:publish`
4. Config package (cf. [below](#config-file)).
5. See [Formsboostrap package documentation](https://github.com/seblhaire/formsbootstrap) to install it and set stylesheets and scripts.
6. Complete Templates (cf. [below](#templates)).

# Configuration

## Configuration file specialauth.php

After publishing the package, modifiy file `specialauth.php` to adapt it for your application. The configuration is accessible
through

```
config('specialauth')
```

* `routeprefix`: path before login, logout and password reset routes. Default `'admin'`.
* `logindest`: route where to redirect user on login success. Default `'adminhome'`.
* `logoutdest`: route where to redirect user on logout. Default `'login'`.
* `resetpasswordfunc`:  function used to send password reset mail. Cf [below](#password-functions).
* `createpasswordfunc`:  function used to send user creation mail. Cf [below](#password-functions).
* `roles`:  lists [user roles](#user-roles) for your application. Will be used to [feed table in database](#database-migration). Default: `['administrator', 'standard_user']`.
* `profile`: lists [user profile items](#user-profile-items) for your application. Will be used to [feed table in database](#database-migration). Default: `[]`.

## Mail Configuration

Your application must be able to send mails by using one of the methods on Laravel official documentation.

# Templates

## Web pages

After publishing the package, you can use and adapt the layout. You must include [Formsboostrap package](https://github.com/seblhaire/formsbootstrap)
scripts to use password utilities. Files can be found in `resources/views/vendor/specialauth`.

# User roles


# User profile items


# Password functions


# Database migration


kernel
protected $routeMiddleware = [
    'guest' => Seblhaire\Specialauth\RedirectIfAuthenticated::class,
