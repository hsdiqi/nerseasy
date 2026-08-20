<?php

namespace App\Enums;

enum MeetingStatus: string
{
    case SCHEDULED = 'scheduled';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

    case ABSENT = 'absent';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Terjadwal',

            self::COMPLETED => 'Selesai',

            self::CANCELLED => 'Dibatalkan',

            self::ABSENT => 'Tidak Hadir',
        };
    }
}