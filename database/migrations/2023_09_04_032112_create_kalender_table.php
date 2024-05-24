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
        Schema::create('kalender', function (Blueprint $table) {
            $table->id('id_kalender');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('prodi', 5);
            $table->string('kelas', 15);
            $table->string('detail', 50)->nullable();

            // Foreign key to prodi table
            $table->foreign('prodi')->references('id_prodi')->on('prodi')->onDelete('cascade');

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
        Schema::dropIfExists('kalender');
    }
};