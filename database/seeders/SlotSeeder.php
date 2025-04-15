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
            $slots[] = [
                'id'         => $i,
                'user_id'    => 1,
                'section_id' => 1,
                'status'     => 'open',
                'name'       => 'A' . $i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('slots')->insert($slots);
    }
}
