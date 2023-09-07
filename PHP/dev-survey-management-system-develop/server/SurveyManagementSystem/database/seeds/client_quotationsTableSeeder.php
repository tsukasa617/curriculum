<?php

use Illuminate\Database\Seeder;

class client_quotationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_quotations')->insert([
            [//1
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'b',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'c',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'e',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//6
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'f',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//7
                //見積書（書類）
                'image_title' => '見積書',
                //見積書画像
                'image_path' => 'g',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
