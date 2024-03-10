<?php

namespace Seblhaire\Specialauth\Models;

use Illuminate\Auth\Authenticatable;
use Seblhaire\Specialauth\Traits\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use Illuminate\Auth\MustVerifyEmail; this is not ncesssary since user mustget an email to create own password
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Seblhaire\Specialauth\Models\Role;
use Seblhaire\Specialauth\Models\Profile;

/* Replaces laravel's user that extends Illuminate\Foundation\Auth\User */

class User extends Eloquent implements
AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable,
        Authorizable,
        CanResetPassword,
        SoftDeletes,
        Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $with = [
        'roles',
        'profiles'
    ];

    public function roles() {
        return $this->belongsToMany('Role');
    }

    public function hasRole($role) {
        return $this->roles()->where('name', $role)->count() > 0;
    }

    public function profiles() {
        return $this->belongsToMany('Profile')->withPivot('jsonvals');
    }

    public function profile($val) {
        $myval = $this->profiles->where('name', $val)->first();
        if (!is_null($myval)) {
            return json_decode($myval->pivot->jsonvals);
        }
        return null;
    }
}
