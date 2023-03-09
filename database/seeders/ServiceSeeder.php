<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'Giúp việc nhà theo giờ',
                'thumbnail' => 'https://www.btaskee.com/wp-content/uploads/2020/11/home-cleaning-banner-ver-25.jpg',
            ],[
                'name' => 'Tổng vệ sinh',
                'thumbnail' => 'https://www.btaskee.com/wp-content/uploads/2020/11/deep-cleaning-banner-ver25.jpg',
            ]
        ]);
    }
}
