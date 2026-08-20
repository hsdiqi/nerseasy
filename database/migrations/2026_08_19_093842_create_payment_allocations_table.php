<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_allocations', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->foreignUuid('payment_id')
                ->constrained('payments')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            /**
             * tutor
             * admin
             * operational
             */
            $table->string('recipient_type', 50);

            /**
             * Digunakan jika recipient adalah tutor.
             */
            $table->foreignUuid('tutor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            /**
             * Bisa digunakan jika penerima adalah
             * admin / owner yang punya akun user.
             */
            $table->foreignUuid('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            /**
             * Nullable karena aturan pembagian
             * mungkin menggunakan fixed amount.
             */
            $table->decimal('percentage', 5, 2)
                ->nullable();

            $table->decimal('amount', 15, 2);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('recipient_type');
            $table->index('tutor_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_allocations');
    }
};