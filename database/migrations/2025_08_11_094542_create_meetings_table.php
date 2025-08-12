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
        Schema::create('meetings', function (Blueprint $t) {
           $t->id();
           $t->string('title');
           $t->text('agenda')->nullable();
           $t->date('date');
           $t->time('startTime');
           $t->time('endTime');
           $t->timestamps();
           $t->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
           $t->foreignId('mom_id')->nullable()->constrained('moms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
