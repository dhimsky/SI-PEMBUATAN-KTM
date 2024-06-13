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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->bigInteger('nim_id')->unsigned();
            $table->string('status');
            $table->string('nama_lengkap', 50);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 15);
            $table->string('agama_id', 5);
            $table->string('email', 35);
            $table->string('nohp', 15);
            $table->string('pas_foto', 15)->nullable();

            // Alamat
            $table->string('provinsi', 15);
            $table->string('kabupaten', 15);
            $table->string('kecamatan', 15);
            $table->string('desa_kelurahan', 15);
            $table->integer('rt');
            $table->integer('rw');
            $table->string('nama_jalan', 35);
            $table->integer('kode_pos');

            // Orang Tua Kandung
            $table->string('nama_ayah', 50);
            $table->string('nik_ayah', 16)->nullable();
            $table->string('nama_ibu', 50);
            $table->string('nik_ibu', 16)->nullable();

            // Data Kuliah
            $table->string('prodi_id', 15);
            $table->integer('ukt');
            $table->string('angkatan_id', 5);

            //Foreign Agama
            $table->foreign('agama_id')->references('id_agama')->on('agama')->onDelete('cascade');

            // Foreign key to prodi table
            $table->foreign('prodi_id')->references('id_prodi')->on('prodi')->onDelete('cascade');

            //Foreign Angkatan
            $table->foreign('angkatan_id')->references('id_angkatan')->on('tahunangkatan')->onDelete('cascade');
            // Foreign key to users table
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
        Schema::dropIfExists('pengajuan');
    }
};