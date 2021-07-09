<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetribusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retribusis', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('mPasar_id');
            $table->foreign('mPasar_id')->references('id')->on('master_pasars');

            $table->unsignedBigInteger('pedagang_id');
            $table->foreign('pedagang_id')->references('id')->on('pedagangs');

            $table->unsignedBigInteger('lapak_id');
            $table->foreign('lapak_id')->references('id')->on('lapaks');

            $table->string('tglBayar_retribusi')->nullable();
            $table->string('tarif')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('retribusis');
    }
}
