<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Hash;

class UbereatsAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ubereats:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create and admin user that has all of the necessary permissions.';

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
        $this->info('Create Admin User for Ubereats administration backend');
        $this->createUser();
    }

    /**
     * Create admin user.
     *
     * @return void
     */
    protected function createUser(): void
    {
        // $login           = $this->ask('User Login', 'admin');
        $email           = $this->ask('Email Address', 'admin@ubereatsclone.com');
        $first_name      = $this->ask('First Name', 'Admin');
        $last_name       = $this->ask('Last Name', 'Manager');
        $password        = $this->secret('Password');
        $confirmPassword = $this->secret('Confirm Password');

        // Passwords don't match
        if ($password != $confirmPassword) {
            $this->info("Passwords don't match");
            exit;
        }

        $this->info('Creating admin account');

        $userData = [
            // 'login'        => $login,
            'email'        => $email,
            'first_name'   => $first_name,
            'last_name'    => $last_name,
            'password'     => Hash::make($password),
            'active'       => true
        ];

        try {
            $user = User::create($userData);
            $user->assignRole('super-admin');

            $this->info('User created successfully.');
            $this->info('The User Admin now has full access to your site.');
        } catch (\Exception | QueryException $e) {
            $this->error('User already exists or an error occurred!');
        }
    }
}
