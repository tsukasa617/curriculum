<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('clients', function (Blueprint $table) {
        //No
        $table->increments('id');
        //重要マーク
        $table->string('important');
        //注意マーク
        $table->string('caution');
        // 連結日
        $table->date('submit_date');
        //流入フラグ
        $table->string('advertising')->nullable();
        //ID
        $table->string('member',10)->unique();
        //氏名
        $table->string('contractor');
        //住所
        $table->string('address');
        //物件名
        $table->string('buildingname')->nullable();
        //契約者連絡先
        $table->string('contractor_contact');
        //築年数
        $table->string('building_age')->nullable();
        //保険会社
        $table->string('insurance_company')->nullable();
        //地震 有/無
        $table->boolean('earthquake_flg')->default("0")->nullable();
        //ステータス
        $table->integer('client_status_id')->unsigned()->nullable();
        // アクション日付
        $table->date('action_date')->nullable();
        // アクション内容
        $table->text('action_note')->nullable();
        // 備考
        $table->text('note')->nullable();
        // 入金予測時期
        $table->date('payment_predict_date')->nullable();
        //入金期待値
        $table->string('payment_expecte')->nullable();
        //営業担当
        $table->string('sales_staff')->nullable();
        //調査会社外部キー
        $table->integer('survey_id')->unsigned()->nullable();
        //現調担当
        $table->string('survey_staff')->nullable();
        // 依頼日
        $table->date('request_date')->nullable();
        //現調予定日
        $table->date('scheduled_survey_date')->nullable();
        //現調日
        $table->date('survey_date')->nullable();
        //合意書
        $table->date('agreement_date')->nullable();
        //事故報告日
        $table->date('accident_date')->nullable();
        //保険申請日
        $table->date('insurance_policy_date')->nullable();
        //認定日
        $table->date('certification_date')->nullable();
        //清算(請求書発行)
        $table->date('bill_issue_date')->nullable();
        //入金日
        $table->date('payment_date')->nullable();
        //クオカード送付日
        $table->date('quo_card_date')->nullable();
        //見積額
        $table->integer('quotation_money')->nullable();
        //認定額
        $table->integer('certification_money')->nullable();
        //認定額の認定率
        $table->integer('certification_money_probability')->nullable();
        //請求手数料（％）
        $table->integer('client_fee')->nullable();
        //入金額
        $table->integer('payment_money')->nullable();
        //調査会社手数料（％）
        $table->integer('survey_referral')->nullable();
        //調査会社支払額
        $table->integer('survey_payment_money')->nullable();
        //取次店手数料（％）
        $table->integer('trader_referral')->nullable();
        //取次店支払額
        $table->integer('trader_payment_money')->nullable();
        //利益額
        $table->integer('profit_money')->nullable();
        //保険証券データ
        $table->integer('client_insurance_policy_id')->unsigned()->nullable();
        //合意書データ
        $table->integer('client_agreement_id')->unsigned()->nullable();
        //報告書データ
        $table->integer('client_report_id')->unsigned()->nullable();
        //見積書データ
        $table->integer('client_quotation_id')->unsigned()->nullable();
        //認定書データ
        $table->integer('client_certification_id')->unsigned()->nullable();
        //その他データ
        $table->integer('client_drawing_id')->unsigned()->nullable();
        //取次店
        $table->integer('trader_id')->unsigned()->nullable();
        //登録ユーザー
        $table->integer('user_id')->unsigned()->nullable();
        //ステータス更新履歴
        $table->date('client_status_add')->nullable();
        
        //火災保険会社フラグ
        $table->boolean('fire_insurance_flg')->nullable();  
        //メールアドレス
        $table->string('mail_address',100)->nullable();

        $table->timestamps();
        $table->softDeletes();

        $table->foreign('survey_id')->references('id')->on('surveies')->onDelete('cascade');
        $table->foreign('client_insurance_policy_id')->references('id')->on('client_insurance_policies')->onDelete('cascade');
        $table->foreign('client_drawing_id')->references('id')->on('client_drawings')->onDelete('cascade');
        $table->foreign('client_status_id')->references('id')->on('client_statuses')->onDelete('cascade');
        $table->foreign('client_agreement_id')->references('id')->on('client_agreements')->onDelete('cascade');
        $table->foreign('client_report_id')->references('id')->on('client_reports')->onDelete('cascade');
        $table->foreign('client_quotation_id')->references('id')->on('client_quotations')->onDelete('cascade');
        $table->foreign('client_certification_id')->references('id')->on('client_certifications')->onDelete('cascade');
        $table->foreign('trader_id')->references('id')->on('traders')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
