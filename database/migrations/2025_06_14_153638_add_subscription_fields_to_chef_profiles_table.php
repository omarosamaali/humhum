<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionFieldsToChefProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chef_profiles', function (Blueprint $table) {
            $table->decimal('subscription_3_months_price', 8, 2)->nullable()->after('contract_type');
            $table->decimal('subscription_6_months_price', 8, 2)->nullable()->after('subscription_3_months_price');
            $table->decimal('subscription_12_months_price', 8, 2)->nullable()->after('subscription_6_months_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chef_profiles', function (Blueprint $table) {
            $table->dropColumn(['subscription_3_months_price', 'subscription_6_months_price', 'subscription_12_months_price']);
        });
    }
}
