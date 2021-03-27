<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('bagian_id');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('status_nikah');
            $table->string('pendidikan');
            $table->date('tanggal_masuk');
            $table->string('atas_nama_rekening');
            $table->string('nomor_rekening');
            $table->string('status_pekerja');
            $table->string('foto')->nullable();
            $table->bigInteger('status')->default(0);
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
        Schema::dropIfExists('karyawan');
    }
}
