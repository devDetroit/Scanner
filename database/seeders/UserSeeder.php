<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create(
            [
                'name' => 'admin',
                'username' => 'admin',
                'admin' => 1,
                'active' => 1,
                'password' => Hash::make('temporal')
            ]
        );


        $user = User::create(
            [
                'name' => 'DAXJ Warren Ave',
                'username' => '172.50.16',
                'admin' => 0,
                'active' => 1,
                'password' => Hash::make('temporal')
            ]
        );

        FacilityUser::create(
            [
                'users_id' => $user->id,
                'facilities_id' => 4
            ]
        );

        $user = User::create(
            [
                'name' => 'DAXJ El Paso',
                'username' => '10.0.60',
                'admin' => 0,
                'active' => 1,
                'password' => Hash::make('temporal')
            ]
        );

        FacilityUser::create(
            [
                'users_id' => $user->id,
                'facilities_id' => 3
            ]
        );

        User::create(
            [
                'name' => 'DAXJ Ferndale',
                'username' => '10.10.8',
                'admin' => 0,
                'active' => 1,
                'password' => Hash::make('temporal')
            ]
        );

        $user = User::create(
            [
                'name' => 'DAXJ WH Juarez',
                'username' => '192.168.60',
                'admin' => 0,
                'active' => 1,
                'password' => Hash::make('temporal')
            ]
        );
        FacilityUser::create(
            [
                'users_id' => $user->id,
                'facilities_id' => 2
            ]
        );

        $user = User::create(
            [
                'name' => 'DAXJ Reman',
                'username' => '192.168.81',
                'admin' => 0,
                'active' => 1,
                'password' => Hash::make('temporal')
            ]
        );
        FacilityUser::create(
            [
                'users_id' => $user->id,
                'facilities_id' => 1
            ]
        );
    }
}
