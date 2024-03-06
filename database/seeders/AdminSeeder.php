<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Anass',
            'picture' => '7O2A9773.JPG',
            'email' => 'anass@gmail.com',
            'password' => hash(PASSWORD_BCRYPT, 'anass@gmail.com', true),
        ]);
    }
}
