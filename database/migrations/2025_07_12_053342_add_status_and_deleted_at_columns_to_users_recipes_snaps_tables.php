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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['active', 'inactive', 'cancelled', 'suspended'])
                    ->default('active')
                    ->after('email_verified_at');
            }

            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->timestamp('deleted_at')->nullable()->after('updated_at');
            }
        });

        // تحديث جدول الوصفات إذا لم يكن يحتوي على عمود الحالة
        Schema::table('recipes', function (Blueprint $table) {
            if (!Schema::hasColumn('recipes', 'status')) {
                $table->enum('status', ['active', 'inactive', 'pending', 'rejected'])
                    ->default('active')
                    ->after('id');
            }
        });

        // تحديث جدول الـ snaps إذا لم يكن يحتوي على عمود الحالة
        Schema::table('snaps', function (Blueprint $table) {
            if (!Schema::hasColumn('snaps', 'status')) {
                $table->enum('status', ['active', 'inactive', 'pending', 'rejected'])
                    ->default('active')
                    ->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('recipes', function (Blueprint $table) {
            if (Schema::hasColumn('recipes', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('snaps', function (Blueprint $table) {
            if (Schema::hasColumn('snaps', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
