<?php

namespace App\Console\Commands;

use App\Model\Admin;
use App\Model\Role;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    protected $name;
    protected $email;
    protected $password;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create super admin';

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
     * @return mixed
     */
    public function handle()
    {
        if ($this->asking() == true) {

            $role = Role::where('rolename', 'superadmin')->first();

            if (!$role) {
                $role = Role::create([
                    'rolename' => 'superadmin'
                ]);
            } else {
                $admin = Admin::where('email', $this->email)->first();

                if (!$admin) {
                    $admin = Admin::create([
                        'name' => $this->name,
                        'email' => $this->email,
                        'password' => bcrypt($this->password),
                        'status' => 1

                    ]);
                } else {
                    $this->info("Email Exist, please Create new admin");
                    $this->asking();
                }
                $admin->roles()->sync([$role->id]);
            }


        } else {
            $this->asking();
        }

    }

    public function asking()
    {
        $this->name = $name = $this->ask('what is the name ?');
        $this->email = $this->ask('What is email ?');

        $this->password = $password = $this->ask('what is the password ?, Minimun 8 numbers');

        while (trim(strlen($this->password) < 8)) {
            $this->password = $this->ask('what is the password ?, Minimun 8 numbers');
        }

        $this->info("name: " . $this->name . "\n");
        $this->info("email: " . $this->email . "\n");
        $this->info("password: " . $this->password . "\n");
        if ($this->confirm('Do you wish to continue?')) {
            return true;
        } else {
            return false;
        }

    }
}
