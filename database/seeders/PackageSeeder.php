<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Materi Reguler',
                'category' => 'materi',
                'meeting_quota' => 5,
                'duration_per_meeting' => 60,
                'price' => 500000,
                'valid_days' => 90,
                'status' => 'active',
            ],
            [
                'name' => 'UKOM Reguler',
                'category' => 'ukom_regular',
                'meeting_quota' => 5,
                'duration_per_meeting' => 60,
                'price' => 600000,
                'valid_days' => 90,
                'status' => 'active',
            ],
            [
                'name' => 'UKOM Privat',
                'category' => 'ukom_private',
                'meeting_quota' => 5,
                'duration_per_meeting' => 60,
                'price' => 900000,
                'valid_days' => 90,
                'status' => 'active',
            ],
            [
                'name' => 'Bimbingan Tugas Akhir',
                'category' => 'thesis',
                'meeting_quota' => 5,
                'duration_per_meeting' => 60,
                'price' => 750000,
                'valid_days' => 120,
                'status' => 'active',
            ],
            [
                'name' => 'Kelas Maba Reguler',
                'category' => 'maba_event',
                'meeting_quota' => 1,
                'duration_per_meeting' => 120,
                'price' => 150000,
                'valid_days' => 30,
                'status' => 'active',
            ],
        ];

        foreach ($packages as $package) {
            DB::table('packages')->updateOrInsert(
                [
                    'name' => $package['name'],
                ],
                [
                    ...$package,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}