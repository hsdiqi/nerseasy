<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')
            ->where('email', 'admin@bimbelqueen.test')
            ->value('id');

        $tutorId = DB::table('Users')
            ->where('name', 'Tentor Hasbi')
            ->value('id');

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

        $periodId = DB::table('financial_periods')
            ->where('start_date', '<=', '2026-08-12')
            ->where('end_date', '>=', '2026-08-12')
            ->value('id');

        if (!$periodId) {
            return;
        }

        $amount = 750000;

        $existingPayment = DB::table('payments')
            ->where('student_package_id', $studentPackage->id)
            ->where('paid_at', '2026-08-12 09:00:00')
            ->first();

        if ($existingPayment) {
            $paymentId = $existingPayment->id;
        } else {
            $paymentId = DB::table('payments')->insertGetId([
                'student_package_id' => $studentPackage->id,
                'financial_period_id' => $periodId,
                'recorded_by' => $adminId,

                'paid_at' => '2026-08-12 09:00:00',
                'amount' => $amount,
                'status' => 'paid',

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /**
         * Hapus allocation lama supaya seeder tetap idempotent.
         */
        DB::table('payment_allocations')
            ->where('payment_id', $paymentId)
            ->delete();

        $allocations = [
            [
                'recipient_type' => 'tutor',
                'tutor_id' => $tutorId,
                'user_id' => null,
                'percentage' => 50,
                'amount' => $amount * 0.50,
            ],
            [
                'recipient_type' => 'admin',
                'tutor_id' => null,
                'user_id' => $adminId,
                'percentage' => 20,
                'amount' => $amount * 0.20,
            ],
            [
                'recipient_type' => 'operational',
                'tutor_id' => null,
                'user_id' => null,
                'percentage' => 30,
                'amount' => $amount * 0.30,
            ],
        ];

        foreach ($allocations as $allocation) {
            DB::table('payment_allocations')->insert([
                'payment_id' => $paymentId,

                ...$allocation,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}