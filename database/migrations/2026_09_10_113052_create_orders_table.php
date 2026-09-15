<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('address_id')
                ->constrained('addresses')
                ->restrictOnDelete();

            $table->string('order_number')->unique();

            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);

            $table->enum('payment_method', ['cod'])
                ->default('cod');

            $table->enum('payment_status', ['pending', 'paid', 'failed'])
                ->default('pending');

            $table->enum('status', [
                'pending',
                'confirmed',
                'preparing',
                'ready_for_pickup',
                'picked_up',
                'out_for_delivery',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};