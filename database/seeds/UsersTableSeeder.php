<?php
namespace Seblhaire\Specialauth;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach( config('specialauth.roles') as $role)
        $newrole = new Role;
        $newrole->name = $role;
        $newrole->save();
      }
      foreach( config('specialauth.profiles') as $profile)
        $newprofile = new Profile;
        $newprofile->name = $profile;
        $newprofile->save();
      }
    }
}
