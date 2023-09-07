<?php

use Illuminate\Database\Seeder;

class authsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auths')->insert([
            [
                //権限
                'authority' => json_encode(['1' => '編集', '2' => '削除', '3' => '追加', '4' => 'ユーザー周り','7' => '全画面']),
                //管理者
                'auth_name' => '管理者(マスターアカウント)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ],
            [
                //権限
                'authority' => json_encode(['1' => '編集','2' => '削除','3' => '追加','5' => 'リグラント営業']),
                //管理者
                'auth_name' => '株式会社リグラントadmin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ],
            [
                //権限
                'authority' => json_encode(['1' => '編集', '5' => 'リグラント営業']),
                //管理者
                'auth_name' => '株式会社リグラントmember',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ],
            [
                //権限
                'authority' => json_encode(['1' => '編集', '6' => '調査会社']),
                //管理者
                'auth_name' => '各調査会社アカウント',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ],
            [
                //権限
                'authority' => json_encode(['1' => '編集']),
                //管理者
                'auth_name' => '権限無しアカウント',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL,
            ]
        ]);
    }
}
