<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Anass',
            'picture' => 'pictures/profiles/7O2A9773.JPG',
            'email' => 'anass@gmail.com',
            'password' => Hash::make('anass@gmail.com')
        ]);

        $user->assignRole('admin');
    }
}
