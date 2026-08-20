<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentAllocation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'payment_id',

        'recipient_type',

        'tutor_id',
        'user_id',

        'percentage',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'percentage' => 'decimal:2',
            'amount' => 'decimal:2',
        ];
    }

    /**
     * Transaksi pembayaran induk.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Penerima jika recipient_type = tutor.
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'tutor_id'
        );
    }

    /**
     * Penerima jika berupa admin/user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}