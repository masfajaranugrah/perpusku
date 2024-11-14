<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->bigIncrements('id_buku'); // This creates an auto-incrementing ID field named 'id_buku'
            $table->string('kode_buku'); // This creates an auto-incrementing ID field named 'id_buku'
            $table->string('judul', 255);
            $table->string('pengarang', 255);
            $table->string('jenis', 100)->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('tahun_terbit', 4)->nullable();
            $table->integer('tersedia');
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
};
