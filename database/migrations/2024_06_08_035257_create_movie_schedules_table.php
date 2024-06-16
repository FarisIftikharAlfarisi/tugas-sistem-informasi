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
        Schema::create('movie_schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');;
            $table->foreignId('theater_id')->constrained()->onDelete('cascade');;
            $table->time('show_start');
            $table->time('show_end');
            $table->string('status_approval')->nullable();
            $table->date('tanggal_approval')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_schedules');
    }
};
