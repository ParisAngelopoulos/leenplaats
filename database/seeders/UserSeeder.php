<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Testaccounts, allemaal met het wachtwoord "welkom123"
        $users = [
            ['name' => 'Paris Angelopoulos', 'email' => 'paris@voorbeeld.nl'],
            ['name' => 'Sanne de Vries', 'email' => 'sanne@voorbeeld.nl'],
            ['name' => 'Daan Bakker', 'email' => 'daan@voorbeeld.nl'],
            ['name' => 'Lisa Jansen', 'email' => 'lisa@voorbeeld.nl'],
        ];

        foreach ($users as $user) {
            User::create($user + ['password' => 'welkom123']);
        }
    }
}
