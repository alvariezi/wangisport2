<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed User Demo
        $demoUsers = [
            [
                'name' => 'Super Admin Wangisport',
                'email' => 'admin@wangisport.test',
                'role' => 'admin',
            ],
            [
                'name' => 'Operator Venue Siliwangi',
                'email' => 'tenant@wangisport.test',
                'role' => 'tenant',
            ],
        ];

        foreach ($demoUsers as $user) {
            User::firstOrNew(['email' => $user['email']])
                ->forceFill([
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'status' => 'active',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ])
                ->save();
        }

        // Panggil DemoVenueSeeder
        $this->call([
            DemoVenueSeeder::class,
        ]);
    }
}