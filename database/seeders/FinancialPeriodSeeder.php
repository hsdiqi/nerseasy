<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialPeriodSeeder extends Seeder
{
    public function run(): void
    {
        $periods = [
            [
                'name' => 'Juli 2026',
                'start_date' => '2026-06-11',
                'end_date' => '2026-07-10',
                'status' => 'closed',
            ],
            [
                'name' => 'Agustus 2026',
                'start_date' => '2026-07-11',
                'end_date' => '2026-08-10',
                'status' => 'closed',
            ],
            [
                'name' => 'September 2026',
                'start_date' => '2026-08-11',
                'end_date' => '2026-09-10',
                'status' => 'open',
            ],
        ];

        foreach ($periods as $period) {
            DB::table('financial_periods')->updateOrInsert(
                [
                    'start_date' => $period['start_date'],
                    'end_date' => $period['end_date'],
                ],
                [
                    ...$period,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}