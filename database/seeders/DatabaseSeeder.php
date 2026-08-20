<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

            StudentSeeder::class,

            PackageSeeder::class,
            RevenueRuleSeeder::class,

            StudentPackageSeeder::class,

            FinancialPeriodSeeder::class,

            ScheduleSeeder::class,
            MeetingSeeder::class,

            PaymentSeeder::class,
        ]);
    }
}