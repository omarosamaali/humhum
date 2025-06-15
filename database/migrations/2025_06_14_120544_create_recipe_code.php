// database/migrations/YYYY_MM_DD_HHMMSS_add_recipe_code_to_recipes_table.php

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
        Schema::table('recipes', function (Blueprint $table) {
            // Add the recipe_code column
            $table->string('recipe_code', 5)->unique()->after('id'); // 5 characters, unique, placed after 'id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Drop the recipe_code column if rolling back
            $table->dropColumn('recipe_code');
        });
    }
};
