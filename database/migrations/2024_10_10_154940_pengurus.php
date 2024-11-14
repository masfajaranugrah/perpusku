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
        Schema::create('pengurus', function (Blueprint $table) {
            $table->increments('id_pengurus');
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('username', 50);
            $table->string('password');
            $table->string('telepon', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jabatan', ['Admin', 'Petugas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus');

    }
};
