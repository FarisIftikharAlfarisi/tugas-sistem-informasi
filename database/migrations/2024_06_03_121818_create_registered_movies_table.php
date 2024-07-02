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
            $table->string('durasi');
            $table->integer('harga');
            $table->string('rating');
            $table->longText('deskripsi');
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
        Schema::dropIfExists('registered_movies');
    }
};
