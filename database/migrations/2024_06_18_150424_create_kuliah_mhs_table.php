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
        Schema::create('kuliah_mhs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim_id')->unsigned();
            // Informasi Pendidikan Sebelumnya
            $table->string('asal_sekolah', 50);
            $table->string('jurusan_asal_sekolah', 50);
            $table->text('pengalaman_organisasi')->nullable();
            // Data Kuliah
            $table->string('prodi_id');
            $table->integer('ukt');
            $table->string('angkatan_id');
            $table->string('jenis_tinggal_di_cilacap', 25);
            $table->string('alat_transportasi_ke_kampus', 25);
            $table->string('sumber_biaya_kuliah', 20)->nullable();
            $table->string('penerima_kartu_prasejahtera', 5);
            $table->string('status_mhs', 15);

            $table->foreign('nim_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id_prodi')->on('prodi')->onDelete('cascade');
            $table->foreign('angkatan_id')->references('id_angkatan')->on('tahunangkatan')->onDelete('cascade');
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
        Schema::dropIfExists('kuliah_mhs');
    }
};