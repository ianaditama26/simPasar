<?php

use App\Models\MasterData\Tarif;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPedagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pedagangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedagang_id');
            $table->foreign('pedagang_id')->on('pedagangs')->references('id');

            $table->string('isProcess_pasar')->default('ok');
            $table->string('isVerified_upt')->default(0);
            $table->string('isVerified_diskomindag')->default(0);

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
        Schema::dropIfExists('status_pedagangs');
    }
}
