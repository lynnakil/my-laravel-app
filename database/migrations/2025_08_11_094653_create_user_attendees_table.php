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
        Schema::create('user_attendees', function (Blueprint $t) {
           $t->id();
           $t->string('role')->nullable();
           $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();
           $t->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
           $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attendees');
    }
};
