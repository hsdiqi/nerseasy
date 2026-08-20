<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@bimbelqueen.test',
            ],
            [
                'name' => 'Admin Bimbel Queen',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'owner@bimbelqueen.test',
            ],
            [
                'name' => 'Owner Bimbel Queen',
                'password' => Hash::make('password'),
                'role' => 'owner',
                'status' => 'active',
            ]
        );
    }
}