<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            UserRole::ADMIN,
            UserRole::TUTOR,
            UserRole::OWNER,
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role->value,
            ]);
        }
    }
}
