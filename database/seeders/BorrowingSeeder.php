<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('borrowing')->insert([
            [
                'id' => Str::uuid(),
                'borrower' => 'Juan Dela Cruz',
                'equipment' => 'Dell Laptop L3400',
                'borrowed_date' => Carbon::parse('2025-05-01'),
                'return_date' => Carbon::parse('2025-05-05'),
                'status' => 'Returned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'borrower' => 'Maria Santos',
                'equipment' => 'Epson Projector X200',
                'borrowed_date' => Carbon::parse('2025-05-06'),
                'return_date' => Carbon::parse('2025-05-08'),
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'borrower' => 'Carlos Reyes',
                'equipment' => 'Logitech Wireless Mouse',
                'borrowed_date' => Carbon::parse('2025-05-02'),
                'return_date' => Carbon::parse('2025-05-04'),
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'borrower' => 'Ana Garcia',
                'equipment' => 'Canon DSLR Camera',
                'borrowed_date' => Carbon::parse('2025-04-28'),
                'return_date' => Carbon::parse('2025-05-02'),
                'status' => 'Overdue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'borrower' => 'Mark Villanueva',
                'equipment' => 'Acer Monitor 24in',
                'borrowed_date' => Carbon::parse('2025-05-07'),
                'return_date' => Carbon::parse('2025-05-09'),
                'status' => 'Returned',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
