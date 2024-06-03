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
        Schema::create('registered_movies', function (Blueprint $table) {
            $table->id('movie_id');
            $table->string('poster');
            $table->string('judul');
            $table->string('sutradara');
            $table->string('produser');
            $table->string('bahasa');
            $table->string('bahasa_subtitle');
            $table->string('genre');
            $table->string('sensor');
            $table->string('show_start');
            // $table->foreignId('theater_id')'); {{ belum ada modelnya }}
            $table->string('show_end');
            $table->string('deskripsi');
            $table->string('status_approval');
            $table->string('tanggal_approval');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_movies');
    }
};
