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
            $table->string('nik', 16)->unique();
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 15);
            $table->string('agama_id', 5);
            $table->string('email', 35)->unique();
            $table->string('nohp', 15);
            $table->string('pas_foto', 15)->nullable();

            // Alamat
            $table->string('provinsi', 15);
            $table->string('kabupaten', 15);
            $table->string('kecamatan', 15);
            $table->string('desa_kelurahan', 15);
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('alamat_jalan', 15);

            // Orang Tua Kandung
            $table->string('nama_ayah', 50);
            $table->string('nik_ayah', 16)->nullable();
            $table->string('tempat_lahir_ayah', 20)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah', 20)->nullable();
            $table->string('pekerjaan_ayah', 25)->nullable();
            $table->string('penghasilan_ayah', 15)->nullable();
            $table->string('nama_ibu', 50);
            $table->string('nik_ibu', 16)->nullable();
            $table->string('tempat_lahir_ibu', 20)->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu', 20)->nullable();
            $table->string('pekerjaan_ibu', 25)->nullable();
            $table->string('penghasilan_ibu', 15)->nullable();

            // Wali
            $table->string('nama_wali', 50)->nullable();
            $table->string('alamat_wali', 100)->nullable();

            // Informasi Pendidikan Sebelumnya
            $table->string('asal_sekolah', 50);
            $table->string('jurusan_asal_sekolah', 50);
            $table->text('pengalaman_organisasi')->nullable();

            // Data Kuliah
            $table->string('prodi_id', 15);
            $table->string('ukt', 15);
            $table->string('angkatan_id', 5);
            $table->string('jenis_tinggal_di_cilacap', 25);
            $table->string('alat_transportasi_ke_kampus', 25);
            $table->string('sumber_biaya_kuliah', 20)->nullable();
            $table->string('penerima_kartu_prasejahtera', 5);
            $table->string('status_mhs', 15)->nullable();

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