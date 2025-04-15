<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [];

        for ($i = 0; $i < 12; $i++) {
            $letter = chr(65 + $i); 
            $sections[] = [
                'id' => $i + 1,
                'section_name' => 'Section ' . $letter,
                'section_code' => $letter,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('sections')->insert($sections);
    }
}
