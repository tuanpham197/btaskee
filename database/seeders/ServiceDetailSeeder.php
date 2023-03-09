<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_details')->insert([
            [
                'name' => '2h (55m^2 - 2 phòng)',
                'price' => 149000,
                'service_id' => 1,
            ],
            [
                'name' => '3h (85m^2 - 3 phòng)',
                'price' => 186000,
                'service_id' => 1,
            ],
            [
                'name' => '4h (105m^2 - 4 phòng)',
                'price' => 236000,
                'service_id' => 1,
            ],
            [
                'name' => 'Tối đa 80 m^2  \\n 2 người / 4 giờ',
                'price' => 640000,
                'service_id' => 2,
            ],
            [
                'name' => 'Tối đa 100 m^2 \\n 3 người / 3 giờ',
                'price' => 720000,
                'service_id' => 2,
            ],
            [
                'name' => 'Tối đa 150 m^2 \\n 3 người / 4 giờ',
                'price' => 960000,
                'service_id' => 2,
            ],
        ]);
    }
}
