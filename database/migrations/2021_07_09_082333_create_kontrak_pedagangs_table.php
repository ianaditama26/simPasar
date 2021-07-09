<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakPedagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak_pedagangs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pedagang_id');
            $table->foreign('pedagang_id')->on('pedagangs')->references('id');
            
            $table->unsignedBigInteger('mPasar_id');
            $table->foreign('mPasar_id')->references('id')->on('master_pasars');

            $table->string('noIzin_pedagang');
            $table->date('tglKontrak');
            $table->date('akhirKontrak');
            $table->string('status')->default('verified')->nullable();
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
        Schema::dropIfExists('kontrak_pedagangs');
    }
}
