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
        Schema::table('roles', function (Blueprint $table) {
            // Drop the old unique index
            // Note: Index name might vary by DB, but standard is roles_name_guard_name_unique
            try {
                $table->dropUnique(['name', 'guard_name']);
            } catch (\Exception $e) {
                // If it fails, maybe it's already gone or has a different name
            }

            // Add the new unique index including jenjang_id
            $table->unique(['name', 'guard_name', 'jenjang_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropUnique(['name', 'guard_name', 'jenjang_id']);
            $table->unique(['name', 'guard_name']);
        });
    }
};
