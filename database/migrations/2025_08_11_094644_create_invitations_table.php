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
        Schema::create('invitations', function (Blueprint $t) {
           $t->id();
           $t->string('attendees'); 
           $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();
           $t->foreignId('meeting_id')->constrained('meetings')->cascadeOnDelete();
           $t->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
