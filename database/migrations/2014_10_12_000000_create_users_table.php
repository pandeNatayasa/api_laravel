<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',250);
            $table->string('email',250)->unique();
            $table->string('password',250);
            $table->string('foto_profille',250);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('no_telp',15);
            $table->date('tanggal_lahir');
            $table->enum('status',['1','0']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
