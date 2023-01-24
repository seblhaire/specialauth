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
4. Config package (cf. below).
5. See [Formsboostrap package documentation](https://github.com/seblhaire/formsbootstrap) to install it and set stylesheets and scripts.
6. Complete Templates (cf. below).

# Config file

Accessible through

```php
config('specialauth')
```
* `routeprefix`: path before login, logout and password reset routes, Default `''`.
* `logindest`: route where to redirect user on login success. Default `''`.
'resetpasswordfunc' => '', // App\Utils\Mails::sendResetNotification,
'createpasswordfunc' => '', // App\Utils\Mails::sendCreatePasswordNotification,
'roles' => [
  'administrator',
  'standard_user',
],
'profile' => [
  //'table_max_element',
],







kernel
protected $routeMiddleware = [
    'guest' => Seblhaire\Specialauth\RedirectIfAuthenticated::class,
