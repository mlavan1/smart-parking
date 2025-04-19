<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            ['location_name' => 'Colombo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Dehiwala-Mount Lavinia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Moratuwa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Negombo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Kandy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Galle', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Jaffna', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Batticaloa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Trincomalee', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Anuradhapura', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Polonnaruwa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Mannar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Vavuniya', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Kilinochchi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Point Pedro', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Mullaitivu', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Kurunegala', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Ratnapura', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Badulla', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Matara', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Gampaha', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Nuwara Eliya', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Hambantota', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['location_name' => 'Monaragala', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
