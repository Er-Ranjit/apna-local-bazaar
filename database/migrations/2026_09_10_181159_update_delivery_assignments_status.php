<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE delivery_assignments
            MODIFY status ENUM(
                'assigned',
                'picked_up',
                'out_for_delivery',
                'delivered'
            )
            NOT NULL DEFAULT 'assigned'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE delivery_assignments
            MODIFY status ENUM('assigned')
            NOT NULL DEFAULT 'assigned'
        ");
    }
};
