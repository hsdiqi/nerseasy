<?php

namespace App\Enums;

enum ScheduleStatus: string
{
    case REQUESTED = 'requested';

    case CONFIRMED = 'confirmed';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::REQUESTED => 'Diajukan',

            self::CONFIRMED => 'Dikonfirmasi',

            self::COMPLETED => 'Selesai',

            self::CANCELLED => 'Dibatalkan',
        };
    }
}