<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('statuses')->insert([
            [
                'name' => 'Task-Pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Task-In Progress',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Task-Finished',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Task-Submitted',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
