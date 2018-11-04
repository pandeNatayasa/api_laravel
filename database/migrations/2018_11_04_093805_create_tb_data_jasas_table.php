<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDataJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_jasas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_kategori');
            $table->unsignedInteger('id_admin');
            $table->unsignedInteger('id_user');
            $table->string('pekerjaan',250);
            $table->integer('usia');
            $table->string('no_telp',15);
            $table->string('email',250);
            $table->enum('status',['single','menikah','duda','janda','jomblo']);
            $table->string('alamat',250);
            $table->unsignedInteger('id_kecamatan');
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('id_kategori')->references('id')->on('tb_kategoris');
            $table->foreign('id_admin')->references('id')->on('tb_admins');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_kecamatan')->references('id')->on('tb_kecamatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_data_jasas');
    }
}
