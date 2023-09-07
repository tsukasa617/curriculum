<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traders', function (Blueprint $table) {
            //No
            $table->increments('id');
            //紹介者
            $table->integer('introducer')->nullable();
            //VIP
            $table->boolean('vip_flg')->nullable();
            //取次店（担当者名）
            $table->string('trader_name',100);
            //法人・個人
            $table->boolean('business_form')->nullable();
            //メールアドレス
            $table->string('trader_email')->nullable();
            //所属企業
            $table->string('affiliated_company')->nullable();
            //役職
            $table->string('position')->nullable();
            //郵便番号
            $table->string('trader_zipcode',7)->nullable();
            //住所
            $table->string('trader_address',100);
            //電話番号
            $table->string('trader_phone',13)->unique();
            //電話番号２
            $table->string('trader_phone_2',13)->nullable();
            //金融機関
            $table->string('financial_institution')->nullable();
            //支店名
            $table->string('financial_branch')->nullable();
            //口座種類
            $table->boolean('bank_acount_kinds')->nullable();
            //口座番号
            $table->string('bank_acount_number',18)->nullable();
            //口座名義
            $table->string('bank_acount_name')->nullable();
            //契約書送付日
            $table->date('contract_sending_date')->nullable();
            //契約書締結日
            $table->date('contract_conclusion_date')->nullable();
            //秘密保持契約書データ送付日
            $table->date('secret_contract_date')->nullable();
            //契約書画像
            $table->integer('trader_contract_conclusion_id')->unsigned()->nullable();
            //主な案件
            $table->string('main_project')->nullable();
            //備考
            $table->string('trader_note')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('trader_contract_conclusion_id')->references('id')->on('trader_contract_conclusions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traders');
    }
}
