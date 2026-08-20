<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentPackageSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'student' => 'Alya Putri',
                'package' => 'Bimbingan Tugas Akhir',
                'start_date' => '2026-08-01',
            ],
            [
                'student' => 'Bima Pratama',
                'package' => 'UKOM Reguler',
                'start_date' => '2026-08-05',
            ],
            [
                'student' => 'Citra Maharani',
                'package' => 'UKOM Privat',
                'start_date' => '2026-08-10',
            ],
            [
                'student' => 'Dimas Saputra',
                'package' => 'Materi Reguler',
                'start_date' => '2026-08-12',
            ],
        ];

        foreach ($data as $item) {
            $student = DB::table('students')
                ->where('name', $item['student'])
                ->first();

            $package = DB::table('packages')
                ->where('name', $item['package'])
                ->first();

            if (!$student || !$package) {
                continue;
            }

            $startDate = Carbon::parse($item['start_date']);

            $endDate = $package->valid_days
                ? $startDate->copy()->addDays($package->valid_days)
                : null;

            DB::table('student_packages')->updateOrInsert(
                [
                    'student_id' => $student->id,
                    'package_id' => $package->id,
                    'start_date' => $startDate->toDateString(),
                ],
                [
                    'package_name' => $package->name,
                    'package_price' => $package->price,
                    'duration_per_meeting' => $package->duration_per_meeting,
                    'total_meetings' => $package->meeting_quota,

                    'end_date' => $endDate?->toDateString(),

                    'used_meetings' => 0,
                    'remaining_minutes' => 0,

                    'status' => 'active',

                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}