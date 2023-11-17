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
            'first_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'telephone' => '08123456789',
            'password' => bcrypt('1234567890'),
        ]);

        $admin->assignRole('admin');

        $cashier = User::create([
            'first_name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'email_verified_at' => now(),
            'telephone' => '08123456789',
            'password' => bcrypt('1234567890'),
        ]);

        $cashier->assignRole('cashier');

        $user = User::create([
            'first_name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'telephone' => '08123456789',
            'password' => bcrypt('1234567890'),
        ]);

        $user->assignRole('user');
    }
}
