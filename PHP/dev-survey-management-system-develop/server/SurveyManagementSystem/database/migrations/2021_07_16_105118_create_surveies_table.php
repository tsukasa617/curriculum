<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveies', function (Blueprint $table) {
            //ID
            $table->increments('id');
            //調査会社名
            $table->string('survey_name');
            //郵便番号
            $table->string('survey_zipcode',7)->nullable();
            //住所
            $table->string('survey_address');
            //電話番号
            $table->string('survey_phone',13)->nullable();
            //メールアドレス
            $table->string('survey_mail',100)->nullable();   
            //サイトURL
            $table->string('survey_url')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveies');
    }
}
