<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $slots = [];

        for ($i = 1; $i <= 24; $i++) {
            if($i==10 || $i==7 || $i==22 || $i==18 || $i==1){
                $slots[] = [
                    'id'         => $i,
                    'user_id'    => 1,
                    'parking_lot_id' => 2,
                    'section_id' => 1,
                    'status'     => 'booked',
                    'name'       => 'A' . $i,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            else{
                $slots[] = [
                'id'         => $i,
                'user_id'    => 1,
                'parking_lot_id' => 2,
                'section_id' => 1,
                'status'     => 'open',
                'name'       => 'A' . $i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            }

        }

        DB::table('all_slots')->insert($slots);
    }
}
