<?php

use Illuminate\Database\Seeder;

class surveiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveies')->insert([
            [//1
                //調査会社名
                'survey_name' => '株式会社タテハナグループ',
                //郵便番号
                'survey_zipcode' => '1690075',
                //住所
                'survey_address' => '東京都新宿区高田馬場3-12-8',
                //電話番号
                'survey_phone' => '0344052272',
                //メールアドレス
                'survey_mail' => null,
                //サイトURL
                'survey_url' => null                
            ],
            [//2
                //調査会社名
                'survey_name' => '睦実工務株式会社',
                //郵便番号
                'survey_zipcode' => '1600022',
                //住所
                'survey_address' => '東京都新宿区新宿5−18−20ルックハイツ新宿803',
                //電話番号
                'survey_phone' => '0345008569',
                //メールアドレス
                'survey_mail' => 'mutumi.lifepack@gmail.com',
                //サイトURL
                'survey_url' => null
            ],
            [//3
                //調査会社名
                'survey_name' => '藤翔',
                //郵便番号
                'survey_zipcode' => '5420067',
                //住所
                'survey_address' => '大阪府大阪市中央区松屋町9−6−3-3F',
                //電話番号
                'survey_phone' => '0667685005',
                //メールアドレス
                'survey_mail' => 'info@tosho-corp.com',
                //サイトURL
                'survey_url' => null
            ]
        ]);
    }
}
