<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'greatujah088@gmail.com')
            ->update([
                'email_verified_at' => now(),
                'password' => bcrypt('Cspdgx9y'),
            ]);
    }
}
