<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendors')->insert([
            [
                'user_id' => 2,
                'organization_name' => 'Organization1',
                'address' => '123 Main Street, Cityville',
                'contact_no' => '0771234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'organization_name' => 'Organization2',
                'address' => '456 Elm Avenue, Townsburg',
                'contact_no' => '0771234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'organization_name' => 'Organization3',
                'address' => '789 Airport Road, Jet City',
                'contact_no' => '0771234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
