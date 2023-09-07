<?php

use Illuminate\Database\Seeder;

class client_statusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_statuses')->insert([
            [
                //ステータス
                'status_number' => '0',
                'status_name' => '初回架電前',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '1',
                'status_name' => '再架電',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '2',
                'status_name' => '現調日確定',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '3',
                'status_name' => '検討中（作成前）',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '4',
                'status_name' => '検討中（作成後）',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '5',
                'status_name' => '合意書待ち',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '6',
                'status_name' => '事故報告待ち',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '7',
                'status_name' => '保険申請書類待ち',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '8',
                'status_name' => '認定待ち',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '9',
                'status_name' => '工事/鑑定待ち',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '10',
                'status_name' => '請求中（リグラント）',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '11',
                'status_name' => '完了',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '12',
                'status_name' => 'クロージング前NG',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '13',
                'status_name' => 'クロージングNG',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '14',
                'status_name' => '現調前NG',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '15',
                'status_name' => '現調後NG',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '16',
                'status_name' => '被害なし',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '17',
                'status_name' => '無効',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '18',
                'status_name' => '時効NG',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [
                //ステータス
                'status_number' => '19',
                'status_name' => '日程調整中',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
