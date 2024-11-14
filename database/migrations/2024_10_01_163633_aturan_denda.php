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
        Schema::create('aturan_denda', function (Blueprint $table) {
            $table->string('jenis', 100)->primary();  
            $table->integer('hari_terlambat')->notNull();  
            $table->decimal('biaya_per_hari', 10, 2)->notNull();  
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
        Schema::dropIfExists('aturan_denda');
    }
};
