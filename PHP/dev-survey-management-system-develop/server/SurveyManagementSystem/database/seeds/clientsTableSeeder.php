<?php

use Illuminate\Database\Seeder;

class clientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [//1
                //No
                'id' => '1',
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-5-20',
                //流入フラグ
                'advertising' => 'クオカード1000/3000',
                //ID
                'member' => '1',
                //氏名
                'contractor' => '田中 太郎',
                //住所
                'address' => '東京都○○区○○0-0-0',
                //物件名
                'buildingname' => 'ビル',
                //契約者連絡先
                'contractor_contact' => '00000000000',
                //メールアドレス
                'mail_address' => 'test@test.com',
                //火災保険の加入状況
                'fire_insurance_flg' => '1',
                //築年数
                'building_age' => '5年',
                //保険会社
                'insurance_company' => '損保ジャパン',
                //地震 有/無
                'earthquake_flg' => '0',
                //現状ST
                'client_status_id' => '1',
                // アクション日付
                'action_date' => '2021-5-20',
                // アクション内容
                'action_note' => 'hogehoge',
                // 備考
                'note' => 'hogehoge',
                // 入金予測時期
                'payment_predict_date' => '2021-5-20',
                //入金期待値
                'payment_expecte' => '100%',
                //営業担当
                'sales_staff' => 'テストB',
                //調査会社外部キー
                'survey_id' => '1',
                //現調担当
                'survey_staff' => '橘',
                // 依頼日
                'request_date' => '2021-5-20',
                //現調予定日
                'scheduled_survey_date' => '2021-5-20',
                //現調日
                'survey_date' => '2021-5-20',
                //合意書
                'agreement_date' => '2021-5-20',
                //事故報告日
                'accident_date' => '2021-5-20',
                //保険申請日
                'insurance_policy_date' => '2021-5-20',
                //認定日
                'certification_date' => '2021-5-20',
                //清算(請求書発行)
                'bill_issue_date' => '2021-5-20',
                //入金日
                'payment_date' => '2021-5-20',
                //クオカード送付日
                'quo_card_date' => '2021-5-20',
                //見積額
                'quotation_money' => '200000',
                //認定額
                'certification_money' => '100000',
                //認定額の認定率
                'certification_money_probability' => '10',
                //請求手数料（％）
                'client_fee' => '10',
                //入金額
                'payment_money' => '2000000',
                //調査会社手数料（％）
                'survey_referral' => '5',
                //調査会社支払額
                'survey_payment_money' => '10000',
                //取次店手数料（％）
                'trader_referral' => '5',
                //取次店支払額
                'trader_payment_money' => '10000',
                //利益額
                'profit_money' => '500000',
                //保険証券データ
                'client_insurance_policy_id' => '1',
                //合意書データ
                'client_agreement_id' => '1',
                //報告書データ
                'client_report_id' => '1',
                //見積書データ
                'client_quotation_id' => '1',
                //認定書データ
                'client_certification_id' => '1',
                //その他データ
                'client_drawing_id' => '1',
                //取次店
                'trader_id' => '1',
                //登録ユーザー
                'user_id' => '1',
                //ステータス更新履歴
                'client_status_add' => '2021-10-22',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //No
                'id' => '2',
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-5-20',
                //流入フラグ
                'advertising' => 'クオカード2000/5000',
                //ID
                'member' => '2',
                //氏名
                'contractor' => '田中 太郎',
                //住所
                'address' => '東京都○○区○○0-0-0',
                //物件名
                'buildingname' => 'ビル',
                //契約者連絡先
                'contractor_contact' => '00000000001',
                //メールアドレス
                'mail_address' => 'test@test.com',
                //火災保険の加入状況
                'fire_insurance_flg' => '1',
                //築年数
                'building_age' => '7年',
                //保険会社
                'insurance_company' => '損保ジャパン',
                //地震 有/無
                'earthquake_flg' => '0',
                //現状ST
                'client_status_id' => '1',
                // アクション日付
                'action_date' => '2021-6-20',
                // アクション内容
                'action_note' => 'hogehoge',
                // 備考
                'note' => 'hogehoge',
                // 入金予測時期
                'payment_predict_date' => '2021-6-20',
                //入金期待値
                'payment_expecte' => '75%',
                //営業担当
                'sales_staff' => 'テストB',
                //調査会社外部キー
                'survey_id' => '1',
                //現調担当
                'survey_staff' => '橘',
                // 依頼日
                'request_date' => '2021-6-20',
                //現調予定日
                'scheduled_survey_date' => '2021-6-20',
                //現調日
                'survey_date' => '2021-6-20',
                //合意書
                'agreement_date' => '2021-6-20',
                //事故報告日
                'accident_date' => '2021-6-20',
                //保険申請日
                'insurance_policy_date' => '2021-6-20',
                //認定日
                'certification_date' => '2021-6-20',
                //清算(請求書発行)
                'bill_issue_date' => '2021-6-20',
                //入金日
                'payment_date' => '2021-6-20',
                //クオカード送付日
                'quo_card_date' => '2021-6-20',
                //見積額
                'quotation_money' => '200000',
                //認定額
                'certification_money' => '100000',
                //認定額の認定率
                'certification_money_probability' => '20',
                //請求手数料（％）
                'client_fee' => '20',
                //入金額
                'payment_money' => '2000000',
                //調査会社手数料（％）
                'survey_referral' => '5',
                //調査会社支払額
                'survey_payment_money' => '10000',
                //取次店手数料（％）
                'trader_referral' => '5',
                //取次店支払額
                'trader_payment_money' => '10000',
                //利益額
                'profit_money' => '500000',
                //保険証券データ
                'client_insurance_policy_id' => '2',
                //合意書データ
                'client_agreement_id' => '2',
                //報告書データ
                'client_report_id' => '2',
                //見積書データ
                'client_quotation_id' => '2',
                //認定書データ
                'client_certification_id' => '2',
                //その他データ
                'client_drawing_id' => '2',
                //取次店
                'trader_id' => '1',
                //登録ユーザー
                'user_id' => '2',
                //ステータス更新履歴
                'client_status_add' => '2021-10-22',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //No
                'id' => '3',
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-7-20',
                //流入フラグ
                'advertising' => 'クオカード5000',
                //ID
                'member' => '3',
                //氏名
                'contractor' => '佐藤 史郎',
                //住所
                'address' => '東京都○○区○○0-0-0',
                //物件名
                'buildingname' => 'ビル',
                //契約者連絡先
                'contractor_contact' => '00000000003',
                //メールアドレス
                'mail_address' => 'test@test.com',
                //火災保険の加入状況
                'fire_insurance_flg' => '1',
                //築年数
                'building_age' => '10年',
                //保険会社
                'insurance_company' => '損保ジャパン',
                //地震 有/無
                'earthquake_flg' => '0',
                //現状ST
                'client_status_id' => '2',
                // アクション日付
                'action_date' => '2021-7-20',
                // アクション内容
                'action_note' => 'hogehoge',
                // 備考
                'note' => 'hogehoge',
                // 入金予測時期
                'payment_predict_date' => '2021-7-20',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff' => 'テストB',
                //調査会社外部キー
                'survey_id' => '2',
                //現調担当
                'survey_staff' => '橘',
                // 依頼日
                'request_date' => '2021-6-20',
                //現調予定日
                'scheduled_survey_date' => '2021-6-20',
                //現調日
                'survey_date' => '2021-6-20',
                //合意書
                'agreement_date' => '2021-6-20',
                //事故報告日
                'accident_date' => '2021-6-20',
                //保険申請日
                'insurance_policy_date' => '2021-6-20',
                //認定日
                'certification_date' => '2021-6-20',
                //清算(請求書発行)
                'bill_issue_date' => '2021-6-20',
                //入金日
                'payment_date' => '2021-6-20',
                //クオカード送付日
                'quo_card_date' => '2021-6-20',
                //見積額
                'quotation_money' => '200000',
                //認定額
                'certification_money' => '100000',
                //認定額の認定率
                'certification_money_probability' => '20',
                //請求手数料（％）
                'client_fee' => '20',
                //入金額
                'payment_money' => '2000000',
                //調査会社手数料（％）
                'survey_referral' => '5',
                //調査会社支払額
                'survey_payment_money' => '10000',
                //取次店手数料（％）
                'trader_referral' => '5',
                //取次店支払額
                'trader_payment_money' => '10000',
                //利益額
                'profit_money' => '500000',
                //保険証券データ
                'client_insurance_policy_id' => '3',
                //合意書データ
                'client_agreement_id' => '3',
                //報告書データ
                'client_report_id' => '3',
                //見積書データ
                'client_quotation_id' => '3',
                //認定書データ
                'client_certification_id' => '3',
                //その他データ
                'client_drawing_id' => '3',
                //取次店
                'trader_id' => '1',
                //登録ユーザー
                'user_id' => '3',
                //ステータス更新履歴
                'client_status_add' => '2021-10-22',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //No
                'id' => '4',
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-8-20',
                //流入フラグ
                'advertising' => '取次店',
                //ID
                'member' => '4',
                //氏名
                'contractor' => '鈴木 拓郎',
                //住所
                'address' => '北海道○○区○○0-0-0',
                //物件名
                'buildingname' => 'ビル',
                //契約者連絡先
                'contractor_contact' => '00000000004',
                //メールアドレス
                'mail_address' => 'test@test.com',
                //火災保険の加入状況
                'fire_insurance_flg' => '1',
                //築年数
                'building_age' => '14年',
                //保険会社
                'insurance_company' => '損保ジャパン',
                //地震 有/無
                'earthquake_flg' => '0',
                //現状ST
                'client_status_id' => '3',
                // アクション日付
                'action_date' => '2021-7-20',
                // アクション内容
                'action_note' => 'hogehoge',
                // 備考
                'note' => 'hogehoge',
                // 入金予測時期
                'payment_predict_date' => '2021-7-20',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff' => 'テストB',
                //調査会社外部キー
                'survey_id' => '2',
                //現調担当
                'survey_staff' => '橘',
                // 依頼日
                'request_date' => '2021-6-20',
                //現調予定日
                'scheduled_survey_date' => '2021-6-20',
                //現調日
                'survey_date' => '2021-6-20',
                //合意書
                'agreement_date' => '2021-6-20',
                //事故報告日
                'accident_date' => '2021-6-20',
                //保険申請日
                'insurance_policy_date' => '2021-6-20',
                //認定日
                'certification_date' => '2021-6-20',
                //清算(請求書発行)
                'bill_issue_date' => '2021-6-20',
                //入金日
                'payment_date' => '2021-6-20',
                //クオカード送付日
                'quo_card_date' => '2021-6-20',
                //見積額
                'quotation_money' => '200000',
                //認定額
                'certification_money' => '100000',
                //認定額の認定率
                'certification_money_probability' => '20',
                //請求手数料（％）
                'client_fee' => '20',
                //入金額
                'payment_money' => '2000000',
                //調査会社手数料（％）
                'survey_referral' => '5',
                //調査会社支払額
                'survey_payment_money' => '10000',
                //取次店手数料（％）
                'trader_referral' => '5',
                //取次店支払額
                'trader_payment_money' => '10000',
                //利益額
                'profit_money' => '500000',
                //保険証券データ
                'client_insurance_policy_id' => '4',
                //合意書データ
                'client_agreement_id' => '4',
                //報告書データ
                'client_report_id' => '4',
                //見積書データ
                'client_quotation_id' => '4',
                //認定書データ
                'client_certification_id' => '4',
                //その他データ
                'client_drawing_id' => '4',
                //取次店
                'trader_id' => '1',
                //登録ユーザー
                'user_id' => '4',
                //ステータス更新履歴
                'client_status_add' => '2021-10-22',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //No
                'id' => '5',
                //重要マーク
                'important' => '☆',
                //注意マーク
                'caution' => '△',
                // 連結日
                'submit_date' => '2021-8-20',
                //流入フラグ
                'advertising' => '取次店',
                //ID
                'member' => '5',
                //氏名
                'contractor' => '鈴木 拓郎',
                //住所
                'address' => '北海道○○区○○0-0-0',
                //物件名
                'buildingname' => 'ビル',
                //契約者連絡先
                'contractor_contact' => '00000000005',
                //メールアドレス
                'mail_address' => 'test@test.com',
                //火災保険の加入状況
                'fire_insurance_flg' => '1',
                //築年数
                'building_age' => '14年',
                //保険会社
                'insurance_company' => '損保ジャパン',
                //地震 有/無
                'earthquake_flg' => '0',
                //現状ST
                'client_status_id' => '4',
                // アクション日付
                'action_date' => '2021-7-20',
                // アクション内容
                'action_note' => 'hogehoge',
                // 備考
                'note' => 'hogehoge',
                // 入金予測時期
                'payment_predict_date' => '2021-7-20',
                //入金期待値
                'payment_expecte' => '50%',
                //営業担当
                'sales_staff' => 'テストB',
                //調査会社外部キー
                'survey_id' => '3',
                //現調担当
                'survey_staff' => '橘',
                // 依頼日
                'request_date' => '2021-6-20',
                //現調予定日
                'scheduled_survey_date' => '2021-6-20',
                //現調日
                'survey_date' => '2021-6-20',
                //合意書
                'agreement_date' => '2021-6-20',
                //事故報告日
                'accident_date' => '2021-6-20',
                //保険申請日
                'insurance_policy_date' => '2021-6-20',
                //認定日
                'certification_date' => '2021-6-20',
                //清算(請求書発行)
                'bill_issue_date' => '2021-6-20',
                //入金日
                'payment_date' => '2021-6-20',
                //クオカード送付日
                'quo_card_date' => '2021-6-20',
                //見積額
                'quotation_money' => '200000',
                //認定額
                'certification_money' => '100000',
                //認定額の認定率
                'certification_money_probability' => '20',
                //請求手数料（％）
                'client_fee' => '20',
                //入金額
                'payment_money' => '2000000',
                //調査会社手数料（％）
                'survey_referral' => '5',
                //調査会社支払額
                'survey_payment_money' => '10000',
                //取次店手数料（％）
                'trader_referral' => '5',
                //取次店支払額
                'trader_payment_money' => '10000',
                //利益額
                'profit_money' => '500000',
                //保険証券データ
                'client_insurance_policy_id' => '4',
                //合意書データ
                'client_agreement_id' => '4',
                //報告書データ
                'client_report_id' => '4',
                //見積書データ
                'client_quotation_id' => '4',
                //認定書データ
                'client_certification_id' => '4',
                //その他データ
                'client_drawing_id' => '4',
                //取次店
                'trader_id' => '1',
                //登録ユーザー
                'user_id' => '4',
                //ステータス更新履歴
                'client_status_add' => '2021-10-22',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
