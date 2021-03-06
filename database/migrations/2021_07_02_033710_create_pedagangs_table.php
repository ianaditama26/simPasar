<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedagangs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lapak_id');
            $table->foreign('lapak_id')->references('id')->on('lapaks');

            $table->unsignedBigInteger('mPasar_id');
            $table->foreign('mPasar_id')->references('id')->on('master_pasars');

            $table->unsignedBigInteger('nik')->nullable();
            $table->string('nama');
            $table->string('tempat_tglLahir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->string('noTelp')->nullable();
            $table->string('status')->default('request')->nullable();
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
        Schema::dropIfExists('pedagangs');
    }
}
