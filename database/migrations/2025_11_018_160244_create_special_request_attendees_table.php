<?php

// database/migrations/xxxx_xx_xx_create_special_request_attendees_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('special_request_attendees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('special_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('attendee_id')->constrained('my_family')->onDelete('cascade');
            $table->string('attendee_type'); // 'user' أو 'family_member'
            $table->timestamps();

            $table->unique(['special_request_id', 'attendee_id', 'attendee_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('special_request_attendees');
    }
};