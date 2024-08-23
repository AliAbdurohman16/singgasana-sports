<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => 'Adalah sarana olah raga dan rekreasi keluarga terletak di kawasan exclusive Permukiman Singgasana Pradana – Bandung. Terdapat fasilitas olahraga dan sarana rekreasi untuk warga sekitar & masyarakat luas. Fasilitas tersebut antara lain : Lapangan Tenis Indoor, Basket Indoor, Squash, Tenis Meja, Badminton, Batting Practice, Fitness, Aerobic, Steam, Whirlpool, Jujitsu, Archery, Sport Shop, Swimming Pool, Auditorium, Function Room, dan Pool Side Cafe. ',
            ],
        ];

        Page::insert($pages);
    }
}
