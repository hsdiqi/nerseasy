<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_rules', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));

            $table->foreignUuid('package_id')
                ->constrained('packages')
                ->cascadeOnDelete();

            /**
             * Contoh:
             * tutor
             * admin
             * operational
             */
            $table->string('recipient_type', 50);

            /**
             * percentage
             * fixed
             */
            $table->string('calculation_type', 30)
                ->default('percentage');

            /**
             * Jika percentage:
             * 50 = 50%
             *
             * Jika fixed:
             * 100000 = Rp100.000
             */
            $table->decimal('value', 15, 2);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('recipient_type');

            $table->unique([
                'package_id',
                'recipient_type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_rules');
    }
};