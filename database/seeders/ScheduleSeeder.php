<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')
            ->where('email', 'admin@bimbelqueen.test')
            ->value('id');

        $hasbiId = DB::table('users')
            ->where('name', 'Tentor Hasbi')
            ->value('id');

        $tiyoId = DB::table('users')
            ->where('name', 'Tentor Tiyo')
            ->value('id');

        $alyaPackageId = DB::table('student_packages')
            ->join(
                'students',
                'student_packages.student_id',
                '=',
                'students.id'
            )
            ->where('students.name', 'Alya Putri')
            ->value('student_packages.id');

        $bimaPackageId = DB::table('student_packages')
            ->join(
                'students',
                'student_packages.student_id',
                '=',
                'students.id'
            )
            ->where('students.name', 'Bima Pratama')
            ->value('student_packages.id');

        if ($alyaPackageId) {
            DB::table('schedules')->updateOrInsert(
                [
                    'student_package_id' => $alyaPackageId,
                    'scheduled_at' => '2026-08-15 13:00:00',
                ],
                [
                    'tutor_id' => $hasbiId,
                    'created_by' => $adminId,
                    'requested_date' => '2026-08-15 13:00:00',
                    'status' => 'completed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        if ($bimaPackageId) {
            DB::table('schedules')->updateOrInsert(
                [
                    'student_package_id' => $bimaPackageId,
                    'scheduled_at' => '2026-08-20 10:00:00',
                ],
                [
                    'tutor_id' => $tiyoId,
                    'created_by' => $adminId,
                    'requested_date' => '2026-08-20 09:00:00',
                    'status' => 'confirmed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}