<?php

namespace App\Enums;

enum FinancialPeriodStatus: string
{
    case OPEN = 'open';

    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Buka Buku',

            self::CLOSED => 'Tutup Buku',
        };
    }
}