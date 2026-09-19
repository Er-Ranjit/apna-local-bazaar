<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_assignment_locations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('delivery_assignment_id')
                ->constrained('delivery_assignments')
                ->cascadeOnDelete();

            $table->foreignId('delivery_boy_id')
                ->constrained('delivery_boys')
                ->cascadeOnDelete();

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->decimal('accuracy', 8, 2)->nullable();
            $table->decimal('speed', 8, 2)->nullable();
            $table->decimal('heading', 8, 2)->nullable();

            $table->timestamp('recorded_at')->nullable();

            $table->timestamps();

            $table->index(
                ['delivery_assignment_id', 'recorded_at'],
                'dal_assignment_recorded_at_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_assignment_locations');
    }
};