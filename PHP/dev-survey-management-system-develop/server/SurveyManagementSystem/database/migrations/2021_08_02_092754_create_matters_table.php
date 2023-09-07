<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            //No
            $table->increments('id');
            //重要マーク
            $table->string('important');
            //注意マーク
            $table->string('caution');
            // 連結日
            $table->date('submit_date')->nullable();
            //流入経路外部キー
            $table->integer('advertising_id')->nullable()->unsigned();
            //ID
            $table->integer('member')->unique();
            //グループ
            $table->string('group_name')->nullable();
            //会社名
            $table->string('contractor');
            //建物（名称）
            $table->string('property_information')->nullable();
            //保険契約者名
            $table->string('insurance_policyholder')->nullable();
            //施設名
            $table->string('buildingname')->nullable();
            //住所
            $table->string('address');
            //連絡方法
            $table->string('contact_method');
            //築年数
            $table->string('building_age')->nullable();
            //取次店
            $table->integer('trader_id')->nullable()->unsigned();
            //保険会社
            $table->string('insurance_company')->nullable();
            //台風名
            $table->string('typhoon_name')->nullable();
            //風速
            $table->string('wind_speed')->nullable();
            //風災
            $table->boolean('wind_disaster')->nullable();
            //震災
            $table->boolean('earthquake_disaster')->nullable();
            //進捗状況
            $table->integer('matter_status_id')->nullable()->unsigned();
            //備考
            $table->text('note')->nullable();
            //図面
            $table->boolean('drawing')->nullable();
            //合意書(例:10/01)
            $table->date('agreement_date')->nullable();
            //保険証券
            $table->boolean('insurance_policy')->nullable();
            //商談日
            $table->date('scheduled_survey_date')->nullable();
            //依頼日
            $table->date('request_date')->nullable();
            //現調日(例:10/01)
            $table->date('survey_date')->nullable();
            //現調担当
            $table->string('survey_staff')->nullable();
            //工事コンサル
            $table->string('construction_consultant')->nullable();
            //事故報告
            $table->date('accident_date')->nullable();
            //保険申請日
            $table->date('insurance_policy_date')->nullable();
            //請求用紙到着（民間）(例:10/01)
            $table->date('billing_receipt_date')->nullable();
            //写真UP(例:10/01)
            $table->date('picture_date')->nullable();
            //報告書完成日(例:10/01)
            $table->date('report_completed_date')->nullable();
            //見積書完成日(例:10/01)
            $table->date('quotation_completed_date')->nullable();
            //発送日(例:10/01)
            $table->date('submit_sending_date')->nullable();
            //発送先(保険会社/お客様)
            $table->string('document_submit_to')->nullable();
            //鑑定日(例:10/01)
            $table->date('judge_date')->nullable();
            //認定日(例:10/01)
            $table->date('certification_date')->nullable();
            //顧客請求書送付(例:10/01)
            $table->date('customer_invoice_date')->nullable();
            //請求日(例:10/01)
            $table->date('bill_issue_date')->nullable();
            //入金日(例:10/01)
            $table->date('payment_date')->nullable();
            // アクション日付
            $table->date('action_date')->nullable();
            // アクション内容
            $table->text('action_note')->nullable();
            // アクションログ
            $table->text('action_log')->nullable();
            //入金予測時期
            $table->date('payment_predict_date')->nullable();
            //入金期待値
            $table->string('payment_expecte')->nullable();
            //営業担当
            $table->string('sales_staff')->nullable();
            //案件窓口
            $table->string('contact_matter')->nullable();
            //見積額
            $table->integer('quotation_money')->nullable();
            //認定額
            $table->integer('certification_money')->nullable();
            //見積額の認定率(%)
            $table->integer('quotation_money_probability')->nullable();
            //入金額
            $table->integer('payment_money')->nullable();
            //手数料
            $table->integer('fee')->nullable();

            //調査会社手数料
            $table->integer('survey_referral')->nullable();
            //調査会社支払額
            $table->integer('survey_payment_money')->nullable();
            //紹介率
            $table->integer('referral_rate')->nullable();
            //取次店１支払額
            $table->integer('trader_payment_money_1')->nullable();
            //取次店２
            $table->integer('agency_store_2')->nullable()->unsigned();
            //紹介率２
            $table->integer('referral_rate_2')->nullable();
            //取次店２支払額
            $table->integer('trader_payment_money_2')->nullable();
            //取次店３
            $table->integer('agency_store_3')->nullable()->unsigned();
            //紹介率３
            $table->integer('referral_rate_3')->nullable();
            //取次店３支払額
            $table->integer('trader_payment_money_3')->nullable();
            //紹介率合計
            $table->integer('referral_rate_total')->nullable();
            //取次店支払額
            $table->integer('trader_payment_money')->nullable();
            //利益額
            $table->integer('profit_money')->nullable();

            //保険証券データ
            $table->integer('matter_insurance_policy_id')->nullable()->unsigned();
            //合意書データ
            $table->integer('matter_agreement_id')->nullable()->unsigned();
            //報告書データ
            $table->integer('matter_report_id')->nullable()->unsigned();
            //見積書データ
            $table->integer('matter_quotation_id')->nullable()->unsigned();
            //認定書データ
            $table->integer('matter_certification_id')->nullable()->unsigned();
            //請求書データ
            $table->integer('matter_bill_issue_id')->nullable()->unsigned();
            //図面データ
            $table->integer('matter_drawing_id')->nullable()->unsigned();

            //調査会社外部キー
            $table->integer('survey_id')->nullable()->unsigned();
            //登録ユーザー
            $table->integer('user_id')->unsigned();
            //ステータス更新履歴
            $table->date('matter_status_add')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('advertising_id')->references('id')->on('advertisings')->onDelete('cascade');
            $table->foreign('survey_id')->references('id')->on('surveies')->onDelete('cascade');
            $table->foreign('matter_status_id')->references('id')->on('matter_statuses')->onDelete('cascade');
            $table->foreign('matter_drawing_id')->references('id')->on('matter_drawings')->onDelete('cascade');
            $table->foreign('matter_agreement_id')->references('id')->on('matter_agreements')->onDelete('cascade');
            $table->foreign('matter_insurance_policy_id')->references('id')->on('matter_insurance_policies')->onDelete('cascade');
            $table->foreign('matter_report_id')->references('id')->on('matter_reports')->onDelete('cascade');
            $table->foreign('matter_quotation_id')->references('id')->on('matter_quotations')->onDelete('cascade');
            $table->foreign('matter_certification_id')->references('id')->on('matter_certifications')->onDelete('cascade');
            $table->foreign('matter_bill_issue_id')->references('id')->on('matter_bill_issues')->onDelete('cascade');
            $table->foreign('trader_id')->references('id')->on('traders','agency_store_2','agency_store_3')->onDelete('cascade');
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
        Schema::dropIfExists('matters');
    }
}
