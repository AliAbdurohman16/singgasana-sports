<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PriceDailySeeder::class);
        $this->call(PriceMemberSeeder::class);
    }
}
