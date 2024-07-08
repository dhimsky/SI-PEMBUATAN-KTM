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
        Schema::create('keluarga_mhs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim_id')->unsigned();
            // Orang Tua Kandung
            $table->string('nama_ayah', 50);
            $table->string('nik_ayah', 16)->nullable();
            $table->string('tempat_lahir_ayah', 20)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah', 20)->nullable();
            $table->string('pekerjaan_ayah', 40)->nullable();
            $table->string('penghasilan_ayah', 25)->nullable();
            $table->string('nama_ibu', 50);
            $table->string('nik_ibu', 16)->nullable();
            $table->string('tempat_lahir_ibu', 20)->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu', 20)->nullable();
            $table->string('pekerjaan_ibu', 40)->nullable();
            $table->string('penghasilan_ibu', 25)->nullable();
            // Wali
            $table->string('nama_wali', 50)->nullable();
            $table->string('alamat_wali', 100)->nullable();
            // Tanggungan Keluarga
            $table->integer('jumlah_tanggungan_keluarga_yang_masih_sekolah');
            $table->integer('anak_ke');

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
        Schema::dropIfExists('keluarga_mhs');
    }
};
