<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->id('id_instansi'); // Auto-incrementing primary key
            $table->string('logo')->nullable();
            $table->string('nama', 100); // Name of the instansi
            $table->text('keterangan')->nullable(); // Nullable description
            $table->timestamps(); // Adds created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instansi');
    }
};
