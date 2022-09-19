<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Scanner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 30; $i++) {
            Scanner::create([
                'description' => 'DT-' . $i . '',
                'status' =>  0,
                'facility_id' => 4,
                'active' => 1
            ]);
        }
        for ($i = 1; $i <= 6; $i++) {
            Scanner::create([
                'description' => 'RP-' . $i . '',
                'status' =>  0,
                'facility_id' => 4,
                'active' => 1
            ]);
        }
    }
}
