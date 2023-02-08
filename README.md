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
6. Complete [templates](#templates).
7. Apply [database migrations](#database-migration).
8. Create [main admin account](#create-main-admin-account).

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
* `roles`:  lists [user roles](#roles) for your application. Will be used to [feed table in database](#database-migration). Default: `['administrator', 'standard_user']`.
* `profile`: lists [user profile items](#profile) for your application. Will be used to [feed table in database](#database-migration). Default: `[]`.

## Mail Configuration

Your application must be able to send mails by using one of the methods on Laravel official documentation.

## Kernel.php

In file `app/Http/Kernel.php`, replace line `guest` by the following value:

```
'guest' => \Seblhaire\Specialauth\RedirectIfAuthenticated::class,
```

## auth.php

In file `auth.php`, replace value:

```
providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => \Seblhaire\Specialauth\Models\User::class,
    ],
]
```

# Templates

## Web pages

After publishing the package, you can use and adapt the layout. You must include [Formsboostrap package](https://github.com/seblhaire/formsbootstrap)
scripts to use password utilities. Files can be found in `resources/views/vendor/specialauth`.

## Email templates

You should also adapt email templates to your application. Templates can be found in `resources/views/vendor/specialauth/emails`.
Template `layout.blade.php` is a global template that should not be modified. In `message.blade.php`, you can define the header and footer
for your application. All mails sent by your application can share the same layout. Finally, mail contents can be defined as in `sampple.blade.php`. Feel free
to adapt it to your needs. Mail contents sent by your app are described [below](#mail-functions).

# Database migration

This package comes with a database migration `2014_10_12_000000_specialauth_create_users_table` that includes all necessary Laravel migrations.
Delete files in `database/migrations`.
Then run ` php artisan migrate:install`.  Make sure that [configuration file specialauth.php](#configuration-file-specialauth%2Ephp) is completed with [roles and profiles](#user-roles-and-profile) and finally run migration with `php migrate --seed --seeder=UsersTableSeeder` to create and fill tables.

# User roles and profile

## Roles

## Profile

## File AuthServiceProvider.php

In file ``





UserPolicy

if (\Auth::user()->cant('display', $user)) return redirect()->route('adminhome');



# Mail functions



# Password functions

# Create main admin account
