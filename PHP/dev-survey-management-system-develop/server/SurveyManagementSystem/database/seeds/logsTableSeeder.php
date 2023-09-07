<?php

use Illuminate\Database\Seeder;

class logsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
            [//1
                //操作内容
                'log' => '顧客管理削除',
                //ユーザー外部キー
                'user_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //操作内容
                'log' => '法人案件顧客編集',
                //ユーザー外部キー
                'user_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //操作内容
                'log' => '取次店新規登録',
                //ユーザー外部キー
                'user_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //操作内容
                'log' => '調査会社削除',
                //ユーザー外部キー
                'user_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //操作内容
                'log' => 'アカウント削除',
                //ユーザー外部キー
                'user_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
