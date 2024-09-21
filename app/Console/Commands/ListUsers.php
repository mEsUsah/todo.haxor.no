<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haxor:list-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all(['name', 'email','privilege_id'])
            ->sortBy('name')
            ->map(function($user){
                return $user->mappedFieldsCli();  
            });
        $this->table(
            ['Name', 'Email','Privilege'],
            $users->toArray()
        );
        return Command::SUCCESS;
    }
}
