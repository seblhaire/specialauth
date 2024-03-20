<?php

namespace Seblhaire\Specialauth\Models;

use Seblhaire\Authbase\Models\User as BaseUser;

/* Replaces laravel's user that extends Illuminate\Foundation\Auth\User */

class User extends BaseUser{
    public function roles() {
        return $this->belongsToMany(\Seblhaire\Specialauth\Models\Role::class);
    }

    public function hasRole($role) {
        return $this->roles()->where('name', $role)->count() > 0;
    }

    public function profiles() {
        return $this->belongsToMany(\Seblhaire\Specialauth\Models\Profile::class)->withPivot('jsonvals');
    }

    public function profile($val) {
        $myval = $this->profiles->where('name', $val)->first();
        if (!is_null($myval)) {
            return json_decode($myval->pivot->jsonvals);
        }
        return null;
    }
}
