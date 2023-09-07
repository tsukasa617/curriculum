<?php

use Illuminate\Database\Seeder;

class trader_contract_conclusionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trader_contract_conclusions')->insert([
            [//1
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'b',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'c',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'e',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//6
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'f',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//7
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'g',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//8
                //契約書（書類）
                'image_title' => '契約書',
                //契約書画像
                'image_path' => 'g',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
