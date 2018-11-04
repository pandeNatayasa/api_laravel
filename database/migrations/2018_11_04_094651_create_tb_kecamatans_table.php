<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kecamatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_kecamatan',250);
            $table->unsignedInteger('id_provinsi');
            $table->timestamps();
            
            Schema::disableForeignKeyConstraints();
            $table->foreign('id_provinsi')->references('id')->on('tb_provinsis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kecamatans');
    }
}
