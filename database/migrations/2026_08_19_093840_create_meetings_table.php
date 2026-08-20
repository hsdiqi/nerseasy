<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->foreignUuid('student_package_id')
                ->constrained('student_packages')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            /**
             * Satu schedule maksimal menghasilkan satu meeting.
             */
            $table->foreignUuid('schedule_id')
                ->nullable()
                ->unique()
                ->constrained('schedules')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUuid('tutor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedSmallInteger('meeting_no');

            /**
             * Hak waktu mahasiswa pada pertemuan tersebut.
             *
             * Contoh:
             * base 60 + carry over 15 = 75 menit
             */
            $table->unsignedInteger('allocated_minutes');

            /**
             * Durasi nyata pembelajaran.
             */
            $table->unsignedInteger('actual_minutes')
                ->default(0);

            /**
             * Waktu yang dibawa ke meeting berikutnya.
             */
            $table->unsignedInteger('remaining_minutes')
                ->default(0);

            $table->text('notes')
                ->nullable();

            /**
             * scheduled
             * completed
             * cancelled
             * absent
             */
            $table->string('status', 30)
                ->default('completed');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('status');
            $table->index('tutor_id');

            /**
             * Pertemuan ke-1, 2, 3 dst
             * tidak boleh dobel dalam satu paket mahasiswa.
             */
            $table->unique([
                'student_package_id',
                'meeting_no',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};