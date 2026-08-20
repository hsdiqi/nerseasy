<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingSeeder extends Seeder
{
    public function run(): void
    {
        $studentPackage = DB::table('student_packages')
            ->join(
                'students',
                'student_packages.student_id',
                '=',
                'students.id'
            )
            ->where('students.name', 'Alya Putri')
            ->select('student_packages.*')
            ->first();

        if (!$studentPackage) {
            return;
        }

        $schedule = DB::table('schedules')
            ->where('student_package_id', $studentPackage->id)
            ->where('status', 'completed')
            ->first();

        if (!$schedule) {
            return;
        }

        DB::table('meetings')->updateOrInsert(
            [
                'schedule_id' => $schedule->id,
            ],
            [
                'student_package_id' => $studentPackage->id,
                'tutor_id' => $schedule->tutor_id,

                'meeting_no' => 1,

                'allocated_minutes' => 60,
                'actual_minutes' => 45,
                'remaining_minutes' => 15,

                'notes' => 'Pembahasan awal topik dan struktur tugas akhir.',

                'status' => 'completed',

                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('student_packages')
            ->where('id', $studentPackage->id)
            ->update([
                'used_meetings' => 1,
                'remaining_minutes' => 15,
                'updated_at' => now(),
            ]);
    }
}