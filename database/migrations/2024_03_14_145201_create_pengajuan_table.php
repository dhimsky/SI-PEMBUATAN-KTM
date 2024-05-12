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
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama_id');
            $table->string('email');
            $table->string('nohp');
            $table->string('pas_foto')->nullable();

            // Alamat
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa_kelurahan');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('alamat_jalan');

            // Orang Tua Kandung
            $table->string('nama_ayah');
            $table->string('nik_ayah', 16)->nullable();
            $table->string('tempat_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('nama_ibu');
            $table->string('nik_ibu', 16)->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();

            // Wali
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();

            // Informasi Pendidikan Sebelumnya
            $table->string('asal_sekolah');
            $table->string('jurusan_asal_sekolah');
            $table->text('pengalaman_organisasi')->nullable();

            // Data Kuliah
            $table->string('prodi_id');
            $table->string('ukt');
            $table->string('angkatan_id');
            $table->string('jenis_tinggal_di_cilacap');
            $table->string('alat_transportasi_ke_kampus');
            $table->string('sumber_biaya_kuliah')->nullable();
            $table->string('penerima_kartu_prasejahtera');

            // Tanggungan Keluarga
            $table->integer('jumlah_tanggungan_keluarga_yang_masih_sekolah');
            $table->integer('anak_ke');

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