<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Createmainuser extends Command
{
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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Main administrator name?');
        $email = $this->ask('Main administrator email?');
        $validator = \Validator::make(['email' => $email], [
            'email' => 'required|email:rfc|unique:users',
        ]);
        if ($validator->fails()) {
            $this->error('invalid email: ' . implode('; ', $validator->errors()->all()));
        }else{
            $oUser = new \App\User;
            $oUser->email = $email;
            $oUser->name = $name;
            $oUser->save();
            $oUser->roles()->attach(1);
            $oUser->profiles()->attach(1, ['jsonvals' => '{"val":' . config('tablebuilder.table.itemsperpage') . '}']); // table_max_element
            $mailsent = \Password::broker()->sendResetLink2(['email' => $email]);
            $ok = ($mailsent == \Password::RESET_LINK_SENT);
            if ($ok){
                $this->info('User created. Next step is contained in mail sent to the provided email address');
            }else{
                $this->error('Error creating user');
            }
        }
    }
}
