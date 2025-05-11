<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('rooms')->insert([
                'id' => Str::uuid(),
                'name' => 'Room ' . $i,
                'location' => 'Building ' . chr(64 + $i) . ', Floor ' . rand(1, 3),
                'assigned_tech' => fake()->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
