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
        Schema::create('mahasiswa', function (Blueprint $table) {
            // Data Pribadi
            $table->bigInteger('nim')->unsigned()->primary();
            $table->string('nama_lengkap', 50);
            $table->string('nik', 16)->unique();
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 15);
            $table->string('agama_id');
            $table->string('email', 35)->unique();
            $table->string('nohp', 15);
            $table->string('pas_foto')->nullable();

            $table->foreign('nim')->references('no_identitas')->on('users')->onDelete('cascade');
            $table->foreign('agama_id')->references('id_agama')->on('agama')->onDelete('cascade');
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
        Schema::dropIfExists('mahasiswa');
    }
};