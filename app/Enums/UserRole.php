<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case TUTOR = 'tutor';
    case OWNER = 'owner';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::TUTOR => 'Tentor',
            self::OWNER => 'Owner',
        };
    }
}