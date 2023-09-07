<?php

use Illuminate\Database\Seeder;

class tradersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('traders')->insert([
            [
                 //1
                //紹介者  
                'introducer'=> '2',
                //VIP  
                'vip_flg'=> '0',
                //取次店（担当者名）
                'trader_name'=> '江川 政美',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@hoge.com',
                //所属企業  
                'affiliated_company'=> '株式会社テストA',
                //役職  
                'position'=> '代表取締役社長',
                //郵便番号
                'trader_zipcode'=> '0000000',
                //住所
                'trader_address'=> '福島県双葉郡浪江町大字権現堂鮮町頭0−0',
                //電話番号
                'trader_phone'=> '000-0000-0000',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0000',
                //金融機関
                'financial_institution'=>'三菱',
                //支店名
                'financial_branch'=>'池袋',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'123456',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-01',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-01',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'1',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //2
                //紹介者  
                'introducer'=> '3',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '北澤 学',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@yahoo.co.jp',
                //所属企業  
                'affiliated_company'=> '株式会社テストB',
                //役職  
                'position'=> '営業開発本部  営業部  営業１課  課長',
                //郵便番号
                'trader_zipcode'=> '0000001',
                //住所
                'trader_address'=> '東京都港区台場0-0-0',
                //電話番号
                'trader_phone'=> '000-0000-0001',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0001',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'654321',
                //口座名義
                'bank_acount_name'=>'安藤',
                //契約書送付日  
                'contract_sending_date'=> '2021-05-06',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-01',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'2',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //3
                //紹介者  
                'introducer'=> '4',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '丸山 健次',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@hoge.com',
                //所属企業  
                'affiliated_company'=> '株式会社テストC',
                //役職  
                'position'=> '取締役副社長',
                //郵便番号
                'trader_zipcode'=> '0000002',
                //住所
                'trader_address'=> '東京都港区南青山0-0-0',
                //電話番号
                'trader_phone'=> '000-0000-0002',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0002',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'333333',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-01',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-01',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'3',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //4
                //紹介者  
                'introducer'=> '5',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '石原 厚至',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@yahoo.co.jp',
                //所属企業  
                'affiliated_company'=> '株式会社テストD',
                //役職  
                'position'=> '代表取締役',
                //郵便番号
                'trader_zipcode'=> '0000003',
                //住所
                'trader_address'=> '神奈川県横浜市中区長者町0-0-0テストビル0',
                //電話番号
                'trader_phone'=> '000-0000-0003',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0003',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'444444',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-15',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-15',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'4',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> 'hogehoge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //5
                //紹介者  
                'introducer'=> '6',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '二継 慎吾',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@hoge.com',
                //所属企業  
                'affiliated_company'=> '株式会社テストE',
                //役職  
                'position'=> '代表取締役',
                //郵便番号
                'trader_zipcode'=> '0000004',
                //住所
                'trader_address'=> '福岡市博多区博多駅南0-0-0',
                //電話番号
                'trader_phone'=> '000-0000-0004',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0004',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'555555',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-14',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-14',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'5',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //6
                //紹介者  
                'introducer'=> '7',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '稲生 多美',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@yahoo.co.jp',
                //所属企業  
                'affiliated_company'=> '株式会社テストF',
                //役職  
                'position'=> 'コーポレートビジネス部ビジネスプラザ東京  所長',
                //郵便番号
                'trader_zipcode'=> '0000005',
                //住所
                'trader_address'=> '東京都江東区木場0-0-0',
                //電話番号
                'trader_phone'=> '000-0000-0005',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0005',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'7777777',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-13',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-13',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'6',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //7
                //紹介者  
                'introducer'=> '8',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '岩瀬 加余子',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@hoge.com',
                //所属企業  
                'affiliated_company'=> '株式会社テストG',
                //役職  
                'position'=> '取締役',
                //郵便番号
                'trader_zipcode'=> '0000006',
                //住所
                'trader_address'=> '東京都千代田区九段下0-0-0',
                //電話番号
                'trader_phone'=> '000-0000-0006',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0006',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'888888',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-13',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-13',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'7',
                //主な案件  
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> 'hogehoge',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //8
                //紹介者  
                'introducer'=> '7',
                //VIP  
                'vip_flg'=> '0',
                //取次店
                'trader_name'=> '金本 瑞穂',
                //法人・個人  
                'business_form'=> '0',
                //メールアドレス
                'trader_email'=> 'hogehoge@yahoo.co.jp',
                //所属企業  
                'affiliated_company'=> '株式会社テストH',
                //役職  
                'position'=> '代表取締役',
                //郵便番号
                'trader_zipcode'=> '0000007',
                //住所
                'trader_address'=> '東京都千代田区丸の内0-0-0',
                //電話番号
                'trader_phone'=> '000-0000-0007',
                //電話番号２  
                'trader_phone_2'=> '00-0000-0007',
                //金融機関
                'financial_institution'=>'みずほ',
                //支店名
                'financial_branch'=>'新宿',
                //口座種類
                'bank_acount_kinds'=>'0',
                //口座番号
                'bank_acount_number'=>'999999',
                //口座名義
                'bank_acount_name'=>'松浦',
                //契約書送付日  
                'contract_sending_date'=> '2021-04-13',
                //契約書締結日  
                'contract_conclusion_date'=> '2021-04-15',
                //秘密保持契約書データ送付
                'secret_contract_date'=> '2021-04-01',
                //契約書画像
                'trader_contract_conclusion_id'=>'8',
                //主な案件
                'main_project'=> 'hoge',
                //備考  
                'trader_note'=> '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
