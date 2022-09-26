<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin';

    protected $description = 'Command description';

    public function handle()
    {
        $name = $this->ask('Name:', 'admin');
        $password = $this->ask('Password:', 'admin');
        $email = $this->ask('Email: ', 'admin@admin.com');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}
