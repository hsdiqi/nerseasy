<?php

namespace App\Enums;

enum PackageCategory: string
{
    case MATERIAL = 'material';

    case UKOM_REGULAR = 'ukom_regular';

    case UKOM_PRIVATE = 'ukom_private';

    case THESIS = 'thesis';

    case MABA_EVENT = 'maba_event';

    public function label(): string
    {
        return match ($this) {
            self::MATERIAL => 'Materi',

            self::UKOM_REGULAR => 'UKOM Reguler',

            self::UKOM_PRIVATE => 'UKOM Privat',

            self::THESIS => 'Tugas Akhir / Skripsi',

            self::MABA_EVENT => 'Kelas Maba / Event',
        };
    }
}