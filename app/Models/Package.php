<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'meeting_quota',
        'duration_per_meeting',
        'price',
        'valid_days',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'meeting_quota' => 'integer',
            'duration_per_meeting' => 'integer',
            'price' => 'decimal:2',
            'valid_days' => 'integer',
        ];
    }

    /**
     * Mahasiswa yang mengambil paket ini.
     */
    public function studentPackages(): HasMany
    {
        return $this->hasMany(StudentPackage::class);
    }

    /**
     * Aturan pembagian pendapatan paket.
     */
    public function revenueRules(): HasMany
    {
        return $this->hasMany(RevenueRule::class);
    }
}