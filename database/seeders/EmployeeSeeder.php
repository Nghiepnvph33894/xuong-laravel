<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Department::create([
                'name' => 'Phòng '. $i
            ]);
            Manager::create([
                'name' => fake()->name
            ]);
        }
    }
}
