<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'telephone' => '08123456789',
            'password' => bcrypt('1234567890'),
            'address' => 'Bandung',
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'telephone' => '08123456789',
            'password' => bcrypt('1234567890'),
            'address' => 'Bandung',
        ]);

        $user->assignRole('user');
    }
}
