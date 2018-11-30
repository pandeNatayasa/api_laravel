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
            // $table->unsignedInteger('id_admin');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_user_admin');
            $table->string('pekerjaan',250);
            $table->integer('estimasi_gaji');
            $table->text('pengalaman_kerja');
            $table->integer('usia');
            $table->string('no_telp',15);
            $table->string('email',250);
            $table->enum('status',['single','menikah','duda','janda','jomblo']);
            $table->enum('status_validasi',['valid','non_valid']);
            $table->string('alamat',250);
            $table->timestamps();

            Schema::disableForeignKeyConstraints();
            $table->foreign('id_kategori')->references('id')->on('tb_kategoris');
            // $table->foreign('id_admin')->references('id')->on('tb_admins');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_user_admin')->references('id')->on('users');
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
