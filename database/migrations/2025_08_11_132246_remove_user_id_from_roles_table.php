<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop FK first (if it exists), then the column
            try {
                $table->dropForeign(['user_id']); // default FK name: roles_user_id_foreign
            } catch (\Throwable $e) {
                // ignore if FK doesn't exist
            }

            if (Schema::hasColumn('roles', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Restore the column (nullable to avoid issues), and FK
            if (!Schema::hasColumn('roles', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            }
        });
    }
};
