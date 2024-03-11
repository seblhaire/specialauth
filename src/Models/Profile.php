<?php

namespace Seblhaire\Specialauth\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Profile extends Eloquent {

    public function users() {
        return $this->belongsToMany(\Seblhaire\Specialauth\Models\User);
    }
}
