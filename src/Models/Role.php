<?php

namespace Seblhaire\Specialauth\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Seblhaire\Specialauth\Models\User;

class Role extends Eloquent {

    public function users() {
        return $this->belongsToMany('User');
    }
}
