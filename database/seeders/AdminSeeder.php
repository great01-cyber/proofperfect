<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Ujah John',
            'email' => 'greatujah088@gmail.com',
            'password' => bcrypt('Cspdgx9y'),
            'email_verified_at' => now(),
        ]);
    }
}
