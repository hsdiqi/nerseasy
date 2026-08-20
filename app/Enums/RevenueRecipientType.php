<?php

namespace App\Enums;

enum RevenueRecipientType: string
{
    case TUTOR = 'tutor';

    case ADMIN = 'admin';

    case OPERATIONAL = 'operational';

    public function label(): string
    {
        return match ($this) {
            self::TUTOR => 'Tentor',

            self::ADMIN => 'Admin',

            self::OPERATIONAL => 'Operasional',
        };
    }
}