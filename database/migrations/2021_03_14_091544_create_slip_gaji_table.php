<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slip_gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->date('periode');
            $table->bigInteger('insentif_net_tur');
            $table->bigInteger('insentif_level');
            $table->bigInteger('bonus_insentif');
            $table->bigInteger('tunjangan_ump');
            $table->bigInteger('tunjangan_hp_mms');
            $table->bigInteger('fasilitas_mms');
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
        Schema::dropIfExists('slip_gaji');
    }
}
