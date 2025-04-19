<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ParkingLotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parking_lots')->insert([
            [
                'user_id' => 2,
                'name' => 'Downtown Parking Lot',
                'address' => '123 Main Street, Cityville',
                'hourly_rate' => 80.0,
                'total_slots' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Westside Garage',
                'address' => '456 Elm Avenue, Townsburg',
                'hourly_rate' => 80.5,
                'total_slots' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Airport Long Term',
                'address' => '789 Airport Road, Jet City',
                'hourly_rate' => 80.5,
                'total_slots' => 200,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
