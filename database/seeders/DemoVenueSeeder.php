<?php

namespace Database\Seeders;

use App\Models\Court;
use App\Models\Tenant;
use App\Models\Timeslot;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class DemoVenueSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Venue Demo
        $venue = Venue::firstOrCreate(
            ['code' => 'VNU-SILIWANGI'],
            [
                'slug' => 'gor-siliwangi',
                'name' => 'GOR Siliwangi Sports Center',
                'tax_rate' => 0.1000,
                'service_fee_rate' => 0.0200,
                'status' => 'active',
            ]
        );

        // 2. Buat Tenant Demo
        $tenant = Tenant::firstOrCreate(
            ['code' => 'TNT-SILIWANGI'],
            [
                'venue_id' => $venue->id,
                'slug' => 'siliwangi-futsal',
                'display_name' => 'Siliwangi Arena Futsal & Badminton',
                'status' => 'active',
            ]
        );

        // 3. Buat Lapangan Demo
        $court1 = Court::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'name' => 'Lapangan Futsal A',
            ],
            [
                'type' => 'futsal',
                'surface_type' => 'Rumput Sintetis',
                'is_active' => true,
            ]
        );

        $court2 = Court::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'name' => 'Lapangan Badminton 1',
            ],
            [
                'type' => 'badminton',
                'surface_type' => 'Karpet Vinyl',
                'is_active' => true,
            ]
        );

        // 4. Buat Timeslot Demo
        $timeslots = [
            [
                'start_time' => '08:00:00',
                'end_time' => '09:00:00',
                'base_price' => 120000,
                'is_peak_rate' => false,
            ],
            [
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'base_price' => 120000,
                'is_peak_rate' => false,
            ],
            [
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'base_price' => 180000,
                'is_peak_rate' => true,
            ],
            [
                'start_time' => '19:00:00',
                'end_time' => '20:00:00',
                'base_price' => 180000,
                'is_peak_rate' => true,
            ],
        ];

        foreach ([$court1, $court2] as $court) {
            foreach ($timeslots as $slot) {
                Timeslot::firstOrCreate(
                    [
                        'tenant_id' => $tenant->id,
                        'court_id' => $court->id,
                        'start_time' => $slot['start_time'],
                        'end_time' => $slot['end_time'],
                    ],
                    [
                        'base_price' => $slot['base_price'],
                        'is_peak_rate' => $slot['is_peak_rate'],
                        'is_available' => true,
                    ]
                );
            }
        }
    }
}