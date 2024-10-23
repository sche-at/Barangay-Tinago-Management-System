<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Captain',
                'username' => 'Captain',
                'email' => 'captain@gmail.com',
                'password' => Hash::make('captain123'), // Encrypt password
                'user_type' => 'captain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Secretary',
                'username' => 'Secretary',
                'email' => 'secretary@gmail.com',
                'password' => Hash::make('secretary123'),
                'user_type' => 'secretary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Treasurer',
                'username' => 'Treasurer',
                'email' => 'treasurer@gmail.com',
                'password' => Hash::make('treasurer123'),
                'user_type' => 'treasurer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event Handle',
                'username' => 'Event Handle',
                'email' => 'event@gmail.com',
                'password' => Hash::make('event123'),
                'user_type' => 'event_handler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health Worker',
                'username' => 'Health Worker',
                'email' => 'health@gmail.com',
                'password' => Hash::make('health123'),
                'user_type' => 'health_worker',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
