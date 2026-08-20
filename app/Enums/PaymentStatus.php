<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';

    case PAID = 'paid';

    case CANCELLED = 'cancelled';

    case REFUNDED = 'refunded';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Menunggu Pembayaran',

            self::PAID => 'Lunas',

            self::CANCELLED => 'Dibatalkan',

            self::REFUNDED => 'Dikembalikan',
        };
    }
}