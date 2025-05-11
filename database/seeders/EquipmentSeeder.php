<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipment')->insert([
            [
                'id' => Str::uuid(),
                'room_id' => DB::table('rooms')->where('name', 'Room 1')->value('id'),  // Get the room_id by room name
                'name' => 'Tesla Model Y',
                'description' => 'Electric vehicle',
                'srn' => 'DLLOP7090-2023-001',
                'acq' => '2023-01-01',
                'cost' => 45000,
                'supp_info' => 'Tesla, Inc.',
                'status' => 'Available',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'room_id' => DB::table('rooms')->where('name', 'Room 2')->value('id'),  // Get the room_id by room name
                'name' => 'Tesla Model 3',
                'description' => 'Electric vehicle',
                'srn' => 'DLLOP7090-2023-002',
                'acq' => '2023-02-01',
                'cost' => 35000,
                'supp_info' => 'Tesla, Inc.',
                'status' => 'In Use',
                'condition' => 'Excellent',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'room_id' => DB::table('rooms')->where('name', 'Room 3')->value('id'),  // Get the room_id by room name
                'name' => 'Tesla Model X',
                'description' => 'Electric SUV',
                'srn' => 'DLLOP7090-2023-003',
                'acq' => '2023-03-01',
                'cost' => 65000,
                'supp_info' => 'Tesla, Inc.',
                'status' => 'Available',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'room_id' => DB::table('rooms')->where('name', 'Room 4')->value('id'),  // Get the room_id by room name
                'name' => 'Samsung Galaxy Tab S8',
                'description' => 'Android tablet',
                'srn' => 'DLLOP7090-2023-004',
                'acq' => '2023-04-15',
                'cost' => 700,
                'supp_info' => 'Samsung Electronics',
                'status' => 'Available',
                'condition' => 'New',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'room_id' => DB::table('rooms')->where('name', 'Room 1')->value('id'),  // Get the room_id by room name
                'name' => 'HP Spectre x360',
                'description' => 'Laptop',
                'srn' => 'DLLOP7090-2023-005',
                'acq' => '2023-05-10',
                'cost' => 1500,
                'supp_info' => 'HP Inc.',
                'status' => 'In Use',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
