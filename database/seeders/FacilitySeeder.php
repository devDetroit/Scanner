<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Facility::create(
            [
                'name' => 'REMAN',
                'status' => 1
            ]
        );

        Facility::create(
            [
                'name' => 'TALAMAS',
                'status' => 1
            ]
        );

        Facility::create(
            [
                'name' => 'EL PASO',
                'status' => 1
            ]
        );
        Facility::create(
            [
                'name' => 'DETROIT',
                'status' => 1
            ]
        );
    }
}
