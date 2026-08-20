<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->string('name', 150);

            $table->string('category', 100);

            $table->longText('description')->nullable();

            $table->unsignedSmallInteger('meeting_quota');

            /**
             * Durasi normal satu pertemuan dalam menit.
             *
             * Contoh:
             * 60 = 60 menit
             * 90 = 90 menit
             */
            $table->unsignedSmallInteger('duration_per_meeting');

            $table->decimal('price', 15, 2);

            /**
             * Masa aktif paket dalam hari.
             *
             * Nullable jika suatu paket tidak mempunyai
             * masa kadaluarsa.
             */
            $table->unsignedSmallInteger('valid_days')
                ->nullable();

            $table->string('status', 30)
                ->default('active');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index('category');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};