<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert(
            [
                'name' => env('ADMIN_USERNAME', 'Admin'),
                'email' => env('ADMIN_EMAIL', 'Admin@example.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin123')),
                'user_type_id' => 1,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        );
    }
}
