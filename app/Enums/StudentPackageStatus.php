<?php

namespace App\Enums;

enum StudentPackageStatus: string
{
    case ACTIVE = 'active';

    case COMPLETED = 'completed';

    case EXPIRED = 'expired';

    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Aktif',

            self::COMPLETED => 'Selesai',

            self::EXPIRED => 'Hangus',

            self::CANCELLED => 'Dibatalkan',
        };
    }
}