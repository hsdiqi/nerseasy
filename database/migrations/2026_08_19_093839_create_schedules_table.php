<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->foreignUuid('student_package_id')
                ->constrained('student_packages')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUuid('tutor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            /**
             * Admin yang memasukkan jadwal.
             */
            $table->foreignUuid('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            /**
             * Tanggal yang diajukan peserta.
             */
            $table->dateTime('requested_date');

            /**
             * Jadwal final setelah dikonfirmasi.
             */
            $table->dateTime('scheduled_at')
                ->nullable();

            /**
             * requested
             * confirmed
             * completed
             * cancelled
             */
            $table->string('status', 30)
                ->default('requested');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('requested_date');
            $table->index('scheduled_at');
            $table->index('status');

            $table->index([
                'tutor_id',
                'scheduled_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};