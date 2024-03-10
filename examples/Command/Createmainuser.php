<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Seblhaire\Specialauth\Models\User;

class Createmainuser extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:mainuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create your fist administrator account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        // interactive questions to user
        $name = $this->ask('Main administrator name?');
        $email = $this->ask('Main administrator email?');
        // check if email address is well formed
        $validator = \Validator::make(['email' => $email], [
                    'email' => 'required|email:rfc|unique:users',
        ]);
        if ($validator->fails()) {
            $this->error('invalid email: ' . implode('; ', $validator->errors()->all()));
        } else {
            // create users
            $oUser = new User;
            $oUser->email = $email;
            $oUser->name = $name;
            $oUser->save();
            // assign your user a role, preferably the administrator role or the role that has all priviledges
            $oUser->roles()->attach(1);
            // assign profiles, ie default user preferences
            $oUser->profiles()->attach(1, ['jsonvals' => '{"val":' . config('tablebuilder.table.itemsperpage') . '}']); // table_max_element
            // send the create password mail to the new user
            $mailsent = \Password::broker()->sendResetLink2(['email' => $email]);
            $ok = ($mailsent == \Password::RESET_LINK_SENT);
            if ($ok) {
                $this->info('User created. Next step is contained in mail sent to the provided email address');
            } else {
                $this->error('Error creating user');
            }
        }
    }
}
