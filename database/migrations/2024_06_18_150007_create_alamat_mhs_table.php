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
        Schema::create('alamat_mhs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim_id')->unsigned();
            // Alamat
            $table->string('provinsi', 15);
            $table->string('kabupaten', 15);
            $table->string('kecamatan', 15);
            $table->string('desa_kelurahan', 15);
            $table->integer('rt');
            $table->integer('rw');
            $table->string('nama_jalan', 35);
            $table->integer('kode_pos');

            $table->foreign('nim_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
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
        Schema::dropIfExists('alamat_mhs');
    }
};