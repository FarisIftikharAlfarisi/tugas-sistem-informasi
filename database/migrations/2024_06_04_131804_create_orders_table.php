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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('receipt_number');
            $table->foreignId('schedule_id');
            $table->string('amount');
            $table->string('total_payment');
            $table->string('no_kursi');
            $table->string('status_kursi');
            $table->string('status_pembayaran')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->time('current_time')->nullable();
            $table->time('jam_selesai_film')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
