<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_packages', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->foreignUuid('student_id')
                ->constrained('students')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUuid('package_id')
                ->constrained('packages')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            /*
            |--------------------------------------------------------------------------
            | Snapshot Paket
            |--------------------------------------------------------------------------
            */

            $table->string('package_name', 150);

            $table->decimal('package_price', 15, 2);

            $table->unsignedSmallInteger('duration_per_meeting');

            $table->unsignedSmallInteger('total_meetings');

            /*
            |--------------------------------------------------------------------------
            | Masa Berlaku
            |--------------------------------------------------------------------------
            */

            $table->date('start_date');

            $table->date('end_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Usage
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('used_meetings')
                ->default(0);

            $table->unsignedInteger('remaining_minutes')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status', 30)
                ->default('active');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('status');

            $table->index([
                'student_id',
                'status',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_packages');
    }
};