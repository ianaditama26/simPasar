<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatKontraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_kontraks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('kontrakPedagang_id');
            $table->foreign('kontrakPedagang_id')->on('kontrak_pedagangs')->references('id');

            //tanggal kontrak lama
            $table->date('riwayat_tglKontrak');
            $table->date('riwayat_akhirKontrak');

            $table->string('keterangan');
            $table->string('status')->nullable();

            $table->softDeletes();

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
        Schema::dropIfExists('riwayat_kontraks');
    }
}
