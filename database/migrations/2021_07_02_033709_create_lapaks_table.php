<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mPasar_id');
            $table->foreign('mPasar_id')->on('master_pasars')->references('id');
            $table->unsignedBigInteger('tarif');
            $table->string('seri');
            $table->string('zonasi');
            $table->string('komoditas');
            $table->string('noLapak');
            $table->string('luas')->nullable();
            $table->string('statusLapak')->nullable()->default(0);
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
        Schema::dropIfExists('lapaks');
    }
}
