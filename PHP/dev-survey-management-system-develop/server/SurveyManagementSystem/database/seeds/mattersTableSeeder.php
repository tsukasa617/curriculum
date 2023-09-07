<?php

use Illuminate\Database\Seeder;

class mattersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matters')->insert([
            [//1
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                //連結日
                'submit_date' => '2021-12-20',
                //流入経路外部キー
                'advertising_id' => '1',
                //ID
                'member'=> '0000001',
                //グループ
                'group_name'=> 'IT',
                //会社名
                'contractor'=> '株式会社法人1',
                //建物（名称）
                'property_information'=> '所有物件①',
                //保険契約者名
                'insurance_policyholder'=> '株式会社法人1A',
                //施設名
                'buildingname'=> '事務所・工場',
                //住所
                'address'=> '福島県会津若松市町北町始字深町00-0',
                //連絡方法
                'contact_method'=> 'LINEグループ',
                //築年数
                'building_age'=> '5年',
                //取次店
                'trader_id'=>'1',
                //保険会社
                'insurance_company'=> '損保ジャパン',
                //台風名
                'typhoon_name'=>'10号',
                //風速
                'wind_speed'=>'20m/s',
                //風災
                'wind_disaster'=>'0',
                //震災
                'earthquake_disaster'=>'0',
                //進捗状況
                'matter_status_id'=> '1',
                //備考
                'note'=> 'hogehoge',
                //図面
                'drawing'=> '0',
                //合意書(例:10/01)
                'agreement_date' => '2021-11-20',
                //保険証券
                'insurance_policy' => '0',
                //商談日
                'scheduled_survey_date' => '2021-12-04',
                //依頼日
                'request_date' => '2021-12-04',
                //現調日(例:10/01)
                'survey_date' => '2021-12-04',
                //現調担当
                'survey_staff' => '田中',
                //工事コンサル	＊調査会社非表示
                'construction_consultant' => '0',
                //事故報告(例:10/01)
                'accident_date' => '2021-12-04',
                //保険申請日
                'insurance_policy_date' => '2021-12-05',
                //請求用紙到着（民間）(例:10/01)
                'billing_receipt_date' => '2021-12-12',
                //写真UP(例:10/01)
                'picture_date' => '2021-12-12',
                //報告書完成日(例:10/01)
                'report_completed_date' => '2021-12-10',
                //見積書完成日(例:10/01)
                'quotation_completed_date'=> '2021-12-10',
                //発送日(例:10/01)
                'submit_sending_date'=> '2021-12-12',
                //発送先(保険会社/お客様)
                'document_submit_to'=> '代理店',
                //見積額
                'quotation_money'=> '11954250',
                //鑑定日
                'judge_date'=> '2021-02-11',
                //"認定日(例:10/01)
                'certification_date'=> '2021-02-11',
                //認定額
                'certification_money'=> '1437261',
                //見積額の認定率(%)
                'quotation_money_probability' => '5',
                //"顧客請求書送付(例:10/01)
                'customer_invoice_date'=> '2021-02-11',
                //請求日(例:10/01)
                'bill_issue_date' => '2021-02-10',
                //"入金日(例:10/01)
                'payment_date'=> '2021-02-11',
                //入金額
                'payment_money'=> '200000',
                //手数料  ＊調査会社非表示
                'fee'=> '5',
                // アクション日付
                'action_date'=> '2021-02-06',
                // アクション内容
                'action_note'=> '申請書類待ち',
                // アクションログ
                'action_log'=> '保険交渉中',
                //入金予測時期
                'payment_predict_date' => '2021-02-14',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff'=> 'テストB',
                //案件窓口
                'contact_matter'=> '松浦',

                //調査会社手数料
                'survey_referral' => '10',
                //調査会社支払額
                'survey_payment_money' => '10',
                //紹介率
                'referral_rate' => '5',
                //取次店１支払額
                'trader_payment_money_1' => '10',
                //取次店２
                'agency_store_2' => '1',
                //紹介率２
                'referral_rate_2' => '1',
                //取次店２支払額
                'trader_payment_money_2' => '10',
                //取次店３
                'agency_store_3' => '1',
                //紹介率３
                'referral_rate_3' => '1',
                //取次店３支払額
                'trader_payment_money_3' => '10',
                //紹介率合計
                'referral_rate_total' => '7',
                //取次店支払額
                'trader_payment_money' => '1000',
                //利益額
                'profit_money' => '10',
                
                //保険証券データ
                'matter_insurance_policy_id'=> '1',
                //合意書データ
                'matter_agreement_id'=> '1',
                //報告書データ
                'matter_report_id'=> '1',
                //見積書データ
                'matter_quotation_id'=> '1',
                //認定書データ
                'matter_certification_id'=> '1',
                //請求書データ
                'matter_bill_issue_id'=> '1',
                //図面データ
                'matter_drawing_id'=> '1',

                //調査会社
                'survey_id' => '3',
                //登録ユーザー
                'user_id'=> '1',
                //ステータス更新履歴
                'matter_status_add' => '2021-02-14',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            //２
            [
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-12-20',
                //流入経路外部キー
                'advertising_id' => '2',
                //ID
                'member'=> '0000002',
                //グループ
                'group_name'=> 'IT',
                //会社名
                'contractor'=> '株式会社法人1',
                //建物（名称）
                'property_information'=> '所有物件②',
                //保険契約者名
                'insurance_policyholder'=> '株式会社法人1B',
                //施設名
                'buildingname'=> '倉庫・工場',
                //住所
                'address'=> '福島県会津若松市町北町始字深町00-1',
                //連絡方法
                'contact_method'=> 'LINEグループ',
                //築年数
                'building_age'=> '5年',
                //取次店
                'trader_id'=>'2',
                //保険会社
                'insurance_company'=> '三井住友',
                //台風名
                'typhoon_name'=>'10号',
                //風速
                'wind_speed'=>'20m/s',
                //風災
                'wind_disaster'=>'0',
                //震災
                'earthquake_disaster'=>'0',
                //進捗状況
                'matter_status_id'=> '2',
                //備考
                'note'=> 'hogehoge',
                //図面
                'drawing'=> '0',
                //合意書(例:10/01)
                'agreement_date'=> '2021-11-20',
                //保険証券
                'insurance_policy'=> '0',
                //商談日
                'scheduled_survey_date'=> '2021-12-04',
                //依頼日
                'request_date' => '2021-12-04',
                //現調日(例:10/01)
                'survey_date'=> '2021-12-04',
                //現調担当
                'survey_staff'=> '田中',
                //工事コンサル	＊調査会社非表示
                'construction_consultant'=> '0',
                //事故報告(例:10/01)
                'accident_date'=> '2021-12-04',
                //保険申請日
                'insurance_policy_date' => '2021-12-05',
                //請求用紙到着（民間）(例:10/01)
                'billing_receipt_date'=> '2021-12-12',
                //写真UP(例:10/01)
                'picture_date'=> '2021-12-12',
                //報告書完成日(例:10/01)
                'report_completed_date'=> '2021-12-10',
                //見積書完成日(例:10/01)
                'quotation_completed_date'=> '2021-12-10',
                //発送日(例:10/01)
                'submit_sending_date'=> '2021-12-12',
                //発送先(保険会社/お客様)
                'document_submit_to'=> '代理店',
                //見積額
                'quotation_money'=> '11954250',
                //鑑定日
                'judge_date'=> '2021-02-11',
                //"認定日(例:10/01)
                'certification_date'=> '2021-02-11',
                //認定額
                'certification_money'=> '1437261',
                //見積額の認定率(%)
                'quotation_money_probability' => '5',
                //"顧客請求書送付(例:10/01)
                'customer_invoice_date'=> '2021-02-11',
                //請求日(例:10/01)
                'bill_issue_date' => '2021-02-10',
                //"入金日(例:10/01)
                'payment_date'=> '2021-02-11',
                //入金額
                'payment_money'=> '200000',
                //手数料  ＊調査会社非表示
                'fee'=> '5',
                // アクション日付
                'action_date'=> '2021-02-06',
                // アクション内容
                'action_note'=> '申請書類待ち',
                // アクションログ
                'action_log'=> '保険交渉中',
                //入金予測時期
                'payment_predict_date' => '2021-02-14',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff'=> 'テストB',
                //案件窓口
                'contact_matter'=> '松浦',

                //調査会社手数料
                'survey_referral' => '10',
                //調査会社支払額
                'survey_payment_money' => '10',
                //紹介率
                'referral_rate' => '5',
                //取次店１支払額
                'trader_payment_money_1' => '10',
                //取次店２
                'agency_store_2' => '2',
                //紹介率２
                'referral_rate_2' => '1',
                //取次店２支払額
                'trader_payment_money_2' => '10',
                //取次店３
                'agency_store_3' => '2',
                //紹介率３
                'referral_rate_3' => '1',
                //取次店３支払額
                'trader_payment_money_3' => '10',
                //紹介率合計
                'referral_rate_total' => '7',
                //取次店支払額
                'trader_payment_money' => '1000',
                //利益額
                'profit_money' => '10',

                //保険証券データ
                'matter_insurance_policy_id'=> '1',
                //合意書データ
                'matter_agreement_id'=> '1',
                //報告書データ
                'matter_report_id'=> '1',
                //見積書データ
                'matter_quotation_id'=> '1',
                //認定書データ
                'matter_certification_id'=> '1',
                //請求書データ
                'matter_bill_issue_id'=> '1',
                //図面データ
                'matter_drawing_id'=> '1',

                //調査会社
                'survey_id' => '3',
                //登録ユーザー
                'user_id'=> '2',
                //ステータス更新履歴
                'matter_status_add' => '2021-02-14',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            //３
            [
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-12-20',
                //流入経路外部キー
                'advertising_id' => '1',
                //ID
                'member'=> '0000003',
                //グループ
                'group_name'=> 'IT',
                //会社名
                'contractor'=> '株式会社法人2',
                //建物（名称）
                'property_information'=> '【風災】所有物件',
                //保険契約者名
                'insurance_policyholder'=> '株式会社法人2A',
                //施設名
                'buildingname'=> '越谷工場',
                //住所
                'address'=> '埼玉県越谷市西方0000-1',
                //連絡方法
                'contact_method'=> '000-0000-0000',
                //築年数
                'building_age'=> '5年',
                //取次店
                'trader_id'=>'3',
                //保険会社
                'insurance_company'=> '損保ジャパン',
                //台風名
                'typhoon_name'=>'10号',
                //風速
                'wind_speed'=>'20m/s',
                //風災
                'wind_disaster'=>'0',
                //震災
                'earthquake_disaster'=>'0',
                //進捗状況
                'matter_status_id'=> '3',
                //備考
                'note'=> 'hogehoge',
                //図面
                'drawing'=> '0',
                //合意書(例:10/01)
                'agreement_date'=> '2021-11-20',
                //保険証券
                'insurance_policy'=> '0',
                //商談日
                'scheduled_survey_date'=> '2021-12-04',
                //依頼日
                'request_date' => '2021-12-04',
                //現調日(例:10/01)
                'survey_date'=> '2021-12-04',
                //現調担当
                'survey_staff'=> '田中',
                //工事コンサル	＊調査会社非表示
                'construction_consultant'=> '0',
                //事故報告(例:10/01)
                'accident_date'=> '2021-12-04',
                //保険申請日
                'insurance_policy_date' => '2021-12-05',
                //請求用紙到着（民間）(例:10/01)
                'billing_receipt_date'=> '2021-12-12',
                //写真UP(例:10/01)
                'picture_date'=> '2021-12-12',
                //報告書完成日(例:10/01)
                'report_completed_date'=> '2021-12-10',
                //見積書完成日(例:10/01)
                'quotation_completed_date'=> '2021-12-10',
                //発送日(例:10/01)
                'submit_sending_date'=> '2021-12-12',
                //発送先(保険会社/お客様)
                'document_submit_to'=> '代理店',
                //見積額
                'quotation_money'=> '11954250',
                //鑑定日
                'judge_date'=> '2021-02-11',
                //"認定日(例:10/01)
                'certification_date'=> '2021-02-11',
                //認定額
                'certification_money'=> '1437261',
                //見積額の認定率(%)
                'quotation_money_probability' => '5',
                //"顧客請求書送付(例:10/01)
                'customer_invoice_date'=> '2021-02-11',
                //請求日(例:10/01)
                'bill_issue_date' => '2021-02-10',
                //"入金日(例:10/01)
                'payment_date'=> '2021-02-11',
                //入金額
                'payment_money'=> '200000',
                //手数料  ＊調査会社非表示
                'fee'=> '5',
                // アクション日付
                'action_date'=> '2021-02-06',
                // アクション内容
                'action_note'=> '申請書類待ち',
                // アクションログ
                'action_log'=> '保険交渉中',
                //入金予測時期
                'payment_predict_date' => '2021-02-14',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff'=> 'テストB',
                //案件窓口
                'contact_matter'=> '松浦',

                //調査会社手数料
                'survey_referral' => '10',
                //調査会社支払額
                'survey_payment_money' => '10',
                //紹介率
                'referral_rate' => '5',
                //取次店１支払額
                'trader_payment_money_1' => '10',
                //取次店２
                'agency_store_2' => '3',
                //紹介率２
                'referral_rate_2' => '1',
                //取次店２支払額
                'trader_payment_money_2' => '10',
                //取次店３
                'agency_store_3' => '3',
                //紹介率３
                'referral_rate_3' => '1',
                //取次店３支払額
                'trader_payment_money_3' => '10',
                //紹介率合計
                'referral_rate_total' => '7',
                //取次店支払額
                'trader_payment_money' => '1000',
                //利益額
                'profit_money' => '10',

                //保険証券データ
                'matter_insurance_policy_id'=> '1',
                //合意書データ
                'matter_agreement_id'=> '1',
                //報告書データ
                'matter_report_id'=> '1',
                //見積書データ
                'matter_quotation_id'=> '1',
                //認定書データ
                'matter_certification_id'=> '1',
                //請求書データ
                'matter_bill_issue_id'=> '1',
                //図面データ
                'matter_drawing_id'=> '1',

                //登録ユーザー
                'user_id'=> '3',
                //調査会社
                'survey_id' => '3',
                //ステータス更新履歴
                'matter_status_add' => '2021-02-14',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            //４
            [
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-12-20',
                //流入経路外部キー
                'advertising_id' => '1',
                //ID
                'member'=> '0000004',
                //グループ
                'group_name'=> 'IT',
                //会社名
                'contractor'=> '株式会社法人2',
                //建物（名称）
                'property_information'=> '【破損①】所有物件',
                //保険契約者名
                'insurance_policyholder'=> '株式会社法人2B',
                //施設名
                'buildingname'=> '越谷工場',
                //住所
                'address'=> '埼玉県越谷市西方0000-2',
                //連絡方法
                'contact_method'=> '000-0000-0000',
                //築年数
                'building_age'=> '5年',
                //取次店
                'trader_id'=>'4',
                //保険会社
                'insurance_company'=> '損保ジャパン',
                //台風名
                'typhoon_name'=>'10号',
                //風速
                'wind_speed'=>'20m/s',
                //風災
                'wind_disaster'=>'0',
                //震災
                'earthquake_disaster'=>'0',
                //進捗状況
                'matter_status_id'=> '4',
                //備考
                'note'=> 'hogehoge',
                //図面
                'drawing'=> '0',
                //合意書(例:10/01)
                'agreement_date'=> '2021-11-20',
                //保険証券
                'insurance_policy'=> '0',
                //商談日
                'scheduled_survey_date'=> '2021-12-04',
                //依頼日
                'request_date' => '2021-12-04',
                //現調日(例:10/01)
                'survey_date'=> '2021-12-04',
                //現調担当
                'survey_staff'=> '田中',
                //工事コンサル	＊調査会社非表示
                'construction_consultant'=> '0',
                //事故報告(例:10/01)
                'accident_date'=> '2021-12-04',
                //保険申請日
                'insurance_policy_date' => '2021-12-05',
                //請求用紙到着（民間）(例:10/01)
                'billing_receipt_date'=> '2021-12-12',
                //写真UP(例:10/01)
                'picture_date'=> '2021-12-12',
                //報告書完成日(例:10/01)
                'report_completed_date'=> '2021-12-10',
                //見積書完成日(例:10/01)
                'quotation_completed_date'=> '2021-12-10',
                //発送日(例:10/01)
                'submit_sending_date'=> '2021-12-12',
                //発送先(保険会社/お客様)
                'document_submit_to'=> '代理店',
                //見積額
                'quotation_money'=> '11954250',
                //鑑定日
                'judge_date'=> '2021-02-11',
                //"認定日(例:10/01)
                'certification_date'=> '2021-02-11',
                //認定額
                'certification_money'=> '1437261',
                //見積額の認定率(%)
                'quotation_money_probability' => '5',
                //"顧客請求書送付(例:10/01)
                'customer_invoice_date'=> '2021-02-11',
                //請求日(例:10/01)
                'bill_issue_date' => '2021-02-10',
                //"入金日(例:10/01)
                'payment_date'=> '2021-02-11',
                //入金額
                'payment_money'=> '200000',
                //手数料  ＊調査会社非表示
                'fee'=> '5',
                // アクション日付
                'action_date'=> '2021-02-06',
                // アクション内容
                'action_note'=> '申請書類待ち',
                // アクションログ
                'action_log'=> '保険交渉中',
                //入金予測時期
                'payment_predict_date' => '2021-02-14',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff'=> 'テストB',
                //案件窓口
                'contact_matter'=> '松浦',

                //調査会社手数料
                'survey_referral' => '10',
                //調査会社支払額
                'survey_payment_money' => '10',
                //紹介率
                'referral_rate' => '5',
                //取次店１支払額
                'trader_payment_money_1' => '10',
                //取次店２
                'agency_store_2' => '1',
                //紹介率２
                'referral_rate_2' => '1',
                //取次店２支払額
                'trader_payment_money_2' => '10',
                //取次店３
                'agency_store_3' => '2',
                //紹介率３
                'referral_rate_3' => '1',
                //取次店３支払額
                'trader_payment_money_3' => '10',
                //紹介率合計
                'referral_rate_total' => '7',
                //取次店支払額
                'trader_payment_money' => '1000',
                //利益額
                'profit_money' => '10',

                //保険証券データ
                'matter_insurance_policy_id'=> '1',
                //合意書データ
                'matter_agreement_id'=> '1',
                //報告書データ
                'matter_report_id'=> '1',
                //見積書データ
                'matter_quotation_id'=> '1',
                //認定書データ
                'matter_certification_id'=> '1',
                //請求書データ
                'matter_bill_issue_id'=> '1',
                //図面データ
                'matter_drawing_id'=> '1',

                //登録ユーザー
                'user_id'=> '4',
                //調査会社
                'survey_id' => '3',
                //ステータス更新履歴
                'matter_status_add' => '2021-02-14',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            //５
            [
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-12-20',
                //流入経路外部キー
                'advertising_id' => '1',
                //ID
                'member'=> '0000005',
                //グループ
                'group_name'=> 'IT',
                //会社名
                'contractor'=> '株式会社法人2',
                //建物（名称）
                'property_information'=> '【破損②】所有物件',
                //保険契約者名
                'insurance_policyholder'=> '株式会社法人3B',
                //施設名
                'buildingname'=> '越谷工場',
                //住所
                'address'=> '埼玉県越谷市西方0000-2',
                //連絡方法
                'contact_method'=> '000-0000-0001',
                //築年数
                'building_age'=> '5年',
                //取次店
                'trader_id'=>'5',
                //保険会社
                'insurance_company'=> '損保ジャパン',
                //台風名
                'typhoon_name'=>'10号',
                //風速
                'wind_speed'=>'20m/s',
                //風災
                'wind_disaster'=>'0',
                //震災
                'earthquake_disaster'=>'0',
                //進捗状況
                'matter_status_id'=> '5',
                //備考
                'note'=> 'hogehoge',
                //図面
                'drawing'=> '0',
                //合意書(例:10/01)
                'agreement_date'=> '2021-11-20',
                //保険証券
                'insurance_policy'=> '0',
                //商談日
                'scheduled_survey_date'=> '2021-12-04',
                //依頼日
                'request_date' => '2021-12-04',
                //現調日(例:10/01)
                'survey_date'=> '2021-12-04',
                //現調担当
                'survey_staff'=> '田中',
                //工事コンサル	＊調査会社非表示
                'construction_consultant'=> '1',
                //事故報告(例:10/01)
                'accident_date'=> '2021-12-04',
                //保険申請日
                'insurance_policy_date' => '2021-12-05',
                //請求用紙到着（民間）(例:10/01)
                'billing_receipt_date'=> '2021-12-12',
                //写真UP(例:10/01)
                'picture_date'=> '2021-12-12',
                //報告書完成日(例:10/01)
                'report_completed_date'=> '2021-12-10',
                //見積書完成日(例:10/01)
                'quotation_completed_date'=> '2021-12-10',
                //発送日(例:10/01)
                'submit_sending_date'=> '2021-12-12',
                //発送先(保険会社/お客様)
                'document_submit_to'=> '代理店',
                //見積額
                'quotation_money'=> '11954250',
                //鑑定日
                'judge_date'=> '2021-02-11',
                //"認定日(例:10/01)
                'certification_date'=> '2021-02-11',
                //認定額
                'certification_money'=> '1437261',
                //見積額の認定率(%)
                'quotation_money_probability' => '5',
                //"顧客請求書送付(例:10/01)
                'customer_invoice_date'=> '2021-02-11',
                //請求日(例:10/01)
                'bill_issue_date' => '2021-02-10',
                //"入金日(例:10/01)
                'payment_date'=> '2021-02-11',
                //入金額
                'payment_money'=> '200000',
                //手数料  ＊調査会社非表示
                'fee'=> '5',
                // アクション日付
                'action_date'=> '2021-02-06',
                // アクション内容
                'action_note'=> '申請書類待ち',
                // アクションログ
                'action_log'=> '保険交渉中',
                //入金予測時期
                'payment_predict_date' => '2021-02-14',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff'=> 'テストB',
                //案件窓口
                'contact_matter'=> '松浦',

                //調査会社手数料
                'survey_referral' => '10',
                //調査会社支払額
                'survey_payment_money' => '10',
                //紹介率
                'referral_rate' => '5',
                //取次店１支払額
                'trader_payment_money_1' => '10',
                //取次店２
                'agency_store_2' => '3',
                //紹介率２
                'referral_rate_2' => '1',
                //取次店２支払額
                'trader_payment_money_2' => '10',
                //取次店３
                'agency_store_3' => '1',
                //紹介率３
                'referral_rate_3' => '1',
                //取次店３支払額
                'trader_payment_money_3' => '10',
                //紹介率合計
                'referral_rate_total' => '7',
                //取次店支払額
                'trader_payment_money' => '1000',
                //利益額
                'profit_money' => '10',

                //保険証券データ
                'matter_insurance_policy_id'=> '1',
                //合意書データ
                'matter_agreement_id'=> '1',
                //報告書データ
                'matter_report_id'=> '1',
                //見積書データ
                'matter_quotation_id'=> '1',
                //認定書データ
                'matter_certification_id'=> '1',
                //請求書データ
                'matter_bill_issue_id'=> '1',
                //図面データ
                'matter_drawing_id'=> '1',

                //登録ユーザー
                'user_id'=> '4',
                //調査会社
                'survey_id' => '3',
                //ステータス更新履歴
                'matter_status_add' => '2021-02-14',

                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
