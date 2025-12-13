<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('nomor_hp');
            $table->date('tanggal');
            $table->unsignedBigInteger('paket_id');
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
};
