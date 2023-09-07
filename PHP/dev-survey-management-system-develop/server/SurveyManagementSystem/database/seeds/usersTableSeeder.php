<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                //ログインID
                'login' => '00000001',
                //パスワード
                'password' => Hash::make('//test//'),
                //氏名
                'username' => 'テストA',
                //権限外部キー
                'auth_id' => '1',
                //調査会社名外部キー
                'survey_id' => '1',
                //取次店外部キー
                'trader_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ログインID
                'login' => '00000002',
                //パスワード
                'password' => Hash::make('//test2//'),
                //氏名
                'username' => 'テストB',
                //権限外部キー
                'auth_id' => '2',
                //調査会社名外部キー
                'survey_id' => '2',
                //取次店外部キー
                'trader_id' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ログインID
                'login' => '00000003',
                //パスワード
                'password' => Hash::make('//test3//'),
                //氏名
                'username' => 'テストC',
                //権限外部キー
                'auth_id' => '4',
                //調査会社名外部キー
                'survey_id' => '3',
                //取次店外部キー
                'trader_id' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ログインID
                'login' => '00000004',
                //パスワード
                'password' => Hash::make('//test4//'),
                //氏名
                'username' => 'テストD',
                //権限外部キー
                'auth_id' => '5',
                //調査会社名外部キー
                'survey_id' => '1',
                //取次店外部キー
                'trader_id' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}