<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RevenueRuleSeeder extends Seeder
{
    public function run(): void
    {
        $packages = DB::table('packages')->get();

        foreach ($packages as $package) {
            $rules = [
                [
                    'recipient_type' => 'tutor',
                    'calculation_type' => 'percentage',
                    'value' => 50,
                ],
                [
                    'recipient_type' => 'admin',
                    'calculation_type' => 'percentage',
                    'value' => 20,
                ],
                [
                    'recipient_type' => 'operational',
                    'calculation_type' => 'percentage',
                    'value' => 30,
                ],
            ];

            foreach ($rules as $rule) {
                DB::table('revenue_rules')->updateOrInsert(
                    [
                        'package_id' => $package->id,
                        'recipient_type' => $rule['recipient_type'],
                    ],
                    [
                        'calculation_type' => $rule['calculation_type'],
                        'value' => $rule['value'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}