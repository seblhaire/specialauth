<?php
namespace Seblhaire\Specialauth\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Seblhaire\Specialauth\Models\User;

class Profile extends Eloquent
{

    public function users()
    {
        return $this->belongsToMany('User');
    }
}
