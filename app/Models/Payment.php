<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'student_package_id',
        'financial_period_id',
        'recorded_by',

        'paid_at',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
            'amount' => 'decimal:2',
        ];
    }

    public function studentPackage(): BelongsTo
    {
        return $this->belongsTo(StudentPackage::class);
    }

    public function financialPeriod(): BelongsTo
    {
        return $this->belongsTo(FinancialPeriod::class);
    }

    /**
     * User/admin yang mencatat pembayaran.
     */
    public function recorder(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'recorded_by'
        );
    }

    /**
     * Pembagian uang.
     */
    public function allocations(): HasMany
    {
        return $this->hasMany(PaymentAllocation::class);
    }
}