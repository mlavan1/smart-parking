<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'lavan (admin)',
                'email' => 'admin@gmail.com',
                'contact_number' => '0784456658',
                'usertype' => 'admin',
                'email_verified_at' => null,
                'password' => '$2y$10$1YfOj4ZNx8s2xN93e.2gue8P.9878/s9lf2dEGIO4xGeXEhcYrW02',
                'remember_token' => null,
                'created_at' => Carbon::parse('2025-02-28 17:48:44'),
                'updated_at' => Carbon::parse('2025-02-28 17:48:44'),
            ],
            [
                'id' => 2,
                'name' => 'Keerthigan (vendor)',
                'email' => 'vendor@gmail.com',
                'contact_number' => '0784456658',
                'usertype' => 'vendor',
                'email_verified_at' => null,
                'password' => '$2y$10$1YfOj4ZNx8s2xN93e.2gue8P.9878/s9lf2dEGIO4xGeXEhcYrW02',
                'remember_token' => null,
                'created_at' => Carbon::parse('2025-02-28 17:48:44'),
                'updated_at' => Carbon::parse('2025-02-28 17:48:44'),
            ],
            [
                'id' => 3,
                'name' => 'Jeya ram (gate)',
                'email' => 'gkr@gmail.com',
                'contact_number' => '0784456658',
                'usertype' => 'gate_keeper',
                'email_verified_at' => null,
                'password' => '$2y$10$1YfOj4ZNx8s2xN93e.2gue8P.9878/s9lf2dEGIO4xGeXEhcYrW02',
                'remember_token' => null,
                'created_at' => Carbon::parse('2025-02-28 17:48:44'),
                'updated_at' => Carbon::parse('2025-02-28 17:48:44'),
            ],
            [
                'id' => 4,
                'name' => 'Daniel Kish (user)',
                'email' => 'user@gmail.com',
                'contact_number' => '0784456658',
                'usertype' => 'user',
                'email_verified_at' => null,
                'password' => '$2y$10$1YfOj4ZNx8s2xN93e.2gue8P.9878/s9lf2dEGIO4xGeXEhcYrW02',
                'remember_token' => 'eYe4opSAvX7yMVuoauNflbFgdjdvbOk8s8z0WMLGniaovSjuD2b1WRYmnGW5',
                'created_at' => Carbon::parse('2025-02-28 17:48:44'),
                'updated_at' => Carbon::parse('2025-02-28 17:48:44'),
            ],

        ]);
    }
}
