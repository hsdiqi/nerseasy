<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->foreignUuid('student_package_id')
                ->constrained('student_packages')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUuid('financial_period_id')
                ->constrained('financial_periods')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            /**
             * Admin yang mencatat transaksi.
             */
            $table->foreignUuid('recorded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->dateTime('paid_at');

            $table->decimal('amount', 15, 2);

            /**
             * pending
             * paid
             * cancelled
             * refunded
             */
            $table->string('status', 30)
                ->default('paid');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('paid_at');
            $table->index('status');

            $table->index([
                'financial_period_id',
                'paid_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};