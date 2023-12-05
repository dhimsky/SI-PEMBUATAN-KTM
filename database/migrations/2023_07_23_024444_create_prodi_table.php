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
        Schema::create('prodi', function (Blueprint $table) {
            $table->string('id_prodi')->primary()->unique();
            $table->bigInteger('jurusan_id')->unsigned();
            $table->string('jenjang');
            $table->string('nama_prodi');
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id_jurusan')->on('jurusan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodi');
    }
};