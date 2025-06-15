<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            // Jika kamu ingin hubungan dengan services, aktifkan baris di bawah:
            // $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nama');
            $table->string('no_tlp');
            $table->string('email');
            $table->string('jenis_layanan');
            $table->date('tanggal');
            $table->string('waktu');
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'done'])->default('pending');
            $table->enum('payment_method', ['transfer', 'cash'])->default('cash');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};

