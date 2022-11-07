<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Home;
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
                User::create([
            'first_name' => 'Yudha',
            'last_name' => 'Triya',
            'email' => 'yudhatriya07@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
            Home::create([
            'name' => 'Indo Marga',
            'contact' => '081260991252',
            'description' => 'Indo Marga Adalah Perusahaan adalah sebuah perusahaan multinasional Indonesia yang berkekhususan pada jasa dan produk Internet. Produk-produk tersebut meliputi teknologi pencarian, komputasi web, perangkat lunak, dan periklanan daring. Sebagian besar labanya berasal dari AdWords.',
            'address' => 'Jl. Ikan Arwana LK.III',
            'instagram' => 'https://www.instagram.com/ydhstrs/',
            'linkedin' => 'https://www.linkedin.com/in/yudhatriya/',
            'youtube' => 'https://www.youtube.com/MyWild28"',
        ]);
    }
}
