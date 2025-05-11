<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maintenance')->insert([
            [
                'id' => Str::uuid(),
                'equipment' => 'Printer',
                'issue' => 'Printer not working in Lab 1',
                'date_reported' => Carbon::parse('2025-05-01'),
                'tech_assigned' => 'John Doe',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'equipment' => 'Monitor',
                'issue' => 'Monitor flickering in Room 204',
                'date_reported' => Carbon::parse('2025-05-03'),
                'tech_assigned' => 'Jane Smith',
                'status' => 'In Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'equipment' => 'Printer',

                'issue' => 'Network issue in Admin office',
                'date_reported' => Carbon::parse('2025-05-05'),
                'tech_assigned' => 'Mike Johnson',
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'equipment' => 'keyboard',
                'issue' => 'Broken keyboard in Lab 3',
                'date_reported' => Carbon::parse('2025-05-06'),
                'tech_assigned' => 'Lisa Chan',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'equipment' => 'CPU',
                'issue' => 'Overheating CPU in Room 101',
                'date_reported' => Carbon::parse('2025-05-07'),
                'tech_assigned' => 'Carlos Rivera',
                'status' => 'In Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
