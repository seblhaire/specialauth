# Specialauth

[By Sébastien L'haire](http://sebastien.lhaire.org)

This library is based on Laravel authentication libraries (login, logout, password reset procedure) provided in Laravel Breeze but does not contain registration process.
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
8. Adapt [notifications](#notifications).
9. Create [main admin account](#create-main-admin-account).
10. Define [user roles and profiles](#user_roles_and_profile).
# Configuration

## Configuration file specialauth

After publishing the package, modifiy file `specialauth.php` to adapt it for your application. The configuration is accessible
through

```
config('specialauth')
```

* `routeprefix`: path before login, logout and password reset routes. Default `'admin'`.
* `logindest`: route where to redirect user on login success. Default `'adminhome'`.
* `logoutdest`: route where to redirect user on logout. Default `'login'`.
* `resetpasswordnotification`:  notification class used to send password reset mail. Cf [below](#notifications). Default: `\Seblhaire\Specialauth\ResetPasswordNotification`.
* `createpasswordnotification`:  notification class used to send user creation mail. Cf [below](#notifications). Default: `\Seblhaire\Specialauth\CreatePasswordNotification`.
* `roles`:  lists [user roles](#roles) for your application. Will be used to [feed table in database](#database-migration). Default: `['administrator', 'standard_user']`.
* `profile`: lists [user profile items](#profile) for your application. Will be used to [feed table in database](#database-migration). Default: `[]`.

## Mail Configuration

Your application must be able to send mails by using one of the methods on Laravel official documentation.

## Kernel.php

In file `app/Http/Kernel.php`, in `$routeMiddleware` array, replace line `guest` by the following value:

```
'guest' => \Seblhaire\Specialauth\Http\Requests\RedirectIfAuthenticated::class,
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
scripts to use password utilities. Files can be found in `resources/views/vendor/specialauth/public`.

## Email templates

You should also adapt email templates to your application. Templates can be found in `resources/views/vendor/specialauth/public/emails`.
You can define the header and footer for your application. All mails sent by your application can share the same layout. Finally, mail contents can be defined as in `public/emails/email.blade.php`. Feel free to adapt it to your needs. Mail contents sent by your app are described [below](#notifications).

# Database migration

This package comes with a database migration `2014_10_12_000000_specialauth_create_users_table` that includes all necessary Laravel migrations.
Delete files in your app's `database/migrations`, since we modifiy Laravel default table structure.
Then run ` php artisan migrate:install`.  Make sure that [configuration file specialauth.php](#configuration-file-specialauth) is completed with [roles and profiles](#user-roles-and-profile) and finally run migration with `php migrate --seed --seeder=UsersTableSeeder` to create and fill tables. Later you will need create
your [first user](#create_main_admin_account).

# Notifications

Our package uses two notification classes for two processes. The first one is usual password reset notification that sends a link to an user who has forgotten
his/her password which allows to define a new password. The second sends a link to the same procedure, but it is send to users newly created by a website
administrator.

Notification `\Seblhaire\Specialauth\ResetPasswordNotification` extends `\Illuminate\Auth\Notifications\ResetPassword`. It overloads method `buildMailMessage`
that creates and returns an instance of `\Illuminate\Notifications\Messages\MailMessage`. Theme is the css template stored in `resources/views/vendor/specialauth/pubic/emails/themes` and markdown template in `resources/views/vendor/specialauth/pubic/emails`. If you need change this notification, define your own notification class in `/App/Notification` namespace. Refer to Laravel documentation to know how to format a notification mail.

Notification `\Seblhaire\Specialauth\CreatePasswordNotification` also extends `\Illuminate\Auth\Notifications\ResetPassword`, but extends more methods to customize mail.
If you want to create your own notification class, we suggest that you extend our package class and rewrite method `buildMailMessage`.

You can use template and theme in other notification of your app.

# Create main admin account

This package is designed for applications where users can not sign up to access to admin console, but must be invited by an administrator. When installing an app, you should create your webmaster account. In this package, we give an example file [Createmainuser.php](https://github.com/seblhaire/specialauth/blob/main/examples/Command/Createmainuser.php) that you can adapt to your need and place in your app commands directory. Usually this command should be run only once. Then forms and routes in your application should be used to create users, using the same principles as in the command class.


# User roles and profile

The package modifies default Laravel user model and adds role and profile tables. Model `\Seblhaire\Specialauth\Models\User` uses Laravel standard traits and adds
Eloquent relationships to the `Role` and `Profile` model. If your app needs more relationships, such as links to logs, you can extend our `User` model.  

## Profile

You must first add profile names to the `profiles` table, such as `skin` to choose between themes, `table_max_element` to get the user favorite element number in a table, etc. When you create your app, you can define profiles items in [configuration](#Configuration_file_specialauth) and [seed](#database_migration) them into the database. You can add new profiles to new versions of your app or do it in your app.

 Profiles are attached to user through table `profile_user`. Profile value is stored in `jsonvals` pivot value. You just have to store a JSON object such as
 `{"val": 20}`, or more complex object structures.

 Profiles can be attached to users with `$user->profiles()->attach(1, ['jsonvals' => '{"val":' . config('tablebuilder.table.itemsperpage') . '}'])` where value 1 refers
 to the `id` of the profile value in table `profiles`. The config value here refers to default table size value in package [TableBuilder](https://github.com/seblhaire/tablebuilder/blob/master/config/tablebuilder.php). To change this value, we suggest to first detach value with `$user->roles()->detach(1);` and attach new value.

 If you need to access a profile value of the current user, use  `\Auth::user()->profile('table_max_element')->val` to retrieve the value of this profile item.

## Roles

First of all, you should define precisely differents roles for your app users. Usually, apps define super users who can run all actions and ordinary users that only can do ordinary tasks. But you can define more roles. When creating your application, [database migrations](#database-migration) chapter shows you how
to automatically insert your app roles. However, when updating your app you can easily create new roles, or your app could also allow users to insert new roles.

Users should have at least one role, but table structure allows users to have several roles.

To assign a role to a user, use `$user->roles()->attach(1)` to attach role with `id` 1 in table `roles`. To update roles, first detach all roles with `$user->roles()->detach()` and re-attach updated list.

If you need to know if a user has a role, use `$user->hasRole('administrator')`.

Then you must define how to use roles in your app.

### Policies

Policies define conditions that must be met to allow actions that you can use in controllers. For eample, to update a user, your must either be this user or have
adminstrator role. To display information on a user, you must be this user.

First, you must create a policy class:

```
php artisan make:policy UserPolicy
```

Define policies as in this [example](https://github.com/seblhaire/specialauth/blob/main/examples/Policies/UserPolicy.php) and then use for example this method
to refuse user update.

```
if (\Auth::user()->cant('update_user', $user)) return redirect()->route('adminhome')
```

Dont' forget to register your policies in a Service provider file like [this one](https://github.com/seblhaire/specialauth/blob/main/examples/Policies/UserPolicy.php). In this example, we also add Laravel gate rules that cas for example be used by a route middleware like [this one](https://github.com/seblhaire/specialauth/blob/main/examples/routes/web.php).

# Logout

Route to logout procedure is accessible with the POST method.

1. Insert a link for the logout procedure, in a menu for example:

```
<a id="logout-drop-link" href="">Logout</a>
```

2. Insert a hidden form that posts to your logout route.

```
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
```

3. Submit the hidden form with your link. Here is an example that uses [jQuery library](https://jquery.com).

```
<script>
    jQuery('#logout-drop-link').on('click', function(e){
       e.preventDefault();
       jQuery('#logout-form').submit();
    });
</script>
```
