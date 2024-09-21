<?php

namespace App\Console\Commands;

use App\Events\TaskUpdated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haxor:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Username');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $privilege = 2; // Admin privilege. Can add users via GUI.

        $this->newLine();

        if ($this->confirm('Create this admin user?')) {
            try {
                $user = new User;
                $user->name = $name;
                $user->email = $email;
                $user->password = Hash::make($password);
                $user->privilege_id = $privilege;
                $user->save();
                $this->info('Created user!');
                return Command::SUCCESS;
            } catch (Exception $e) {
                $this->error('Something went wrong!');
                $this->error($e->getMessage());
                return Command::FAILURE;
            }
        }
    }
}