<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->string('name', 150);
            $table->string('phone', 30)
                ->nullable();
            $table->string('email');
            $table->string('campus_name');
            $table->string('campus_type');
            $table->string('status', 30)
                ->default('active');
            $table->date('registered_at')
                ->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index('name');
            $table->index('status');
            $table->index('registered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};