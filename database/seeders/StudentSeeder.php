<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {

        $students = [
            [
                'name' => 'Alya Putri',
                'phone' => '081234567801',
                'status' => 'active',
                'registered_at' => '2026-07-15',
            ],
            [
                'name' => 'Bima Pratama',
                'phone' => '081234567802',
                'status' => 'active',
                'registered_at' => '2026-07-20',
            ],
            [
                'name' => 'Citra Maharani',
                'phone' => '081234567803',
                'status' => 'active',
                'registered_at' => '2026-08-01',
            ],
            [
                'name' => 'Dimas Saputra',
                'phone' => '081234567804',
                'status' => 'active',
                'registered_at' => '2026-08-05',
            ],
            [
                'name' => 'Eka Ramadhani',
                'phone' => '081234567805',
                'status' => 'inactive',
                'registered_at' => '2026-05-10',
            ],
        ];

        foreach ($students as $student) {
            DB::table('students')->updateOrInsert(
                [
                    'name' => $student['name'],
                    'phone' => $student['phone'],
                ],
                [
                    ...$student,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}