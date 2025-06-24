<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_contract_signed')->default(false)->after('email_verified_at');
            $table->string('otp_code')->nullable()->after('is_contract_signed');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            $table->timestamp('contract_signed_at')->nullable()->after('otp_expires_at'); // لتسجيل وقت التوقيع
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_contract_signed', 'otp_code', 'otp_expires_at', 'contract_signed_at']);
        });
    }
}
