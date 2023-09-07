<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            //ID
            $table->increments('id');
            //ログインID
            $table->string('login',30)->unique();
            //氏名
            $table->string('username',20);
            //パスワード
            $table->string('password',255);
            //権限外部キー
            $table->integer('auth_id')->unsigned();
            //調査会社外部キー
            $table->integer('survey_id')->unsigned();
            //取次店外部キー
            $table->integer('trader_id')->unsigned()->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('auth_id')->references('id')->on('auths')->onDelete('cascade');
            $table->foreign('survey_id')->references('id')->on('surveies')->onDelete('cascade');
            $table->foreign('trader_id')->references('id')->on('traders')->onDelete('cascade');
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
