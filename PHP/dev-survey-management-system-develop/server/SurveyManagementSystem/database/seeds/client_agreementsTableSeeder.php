<?php

use Illuminate\Database\Seeder;

class client_agreementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_agreements')->insert([
            [//1
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'b',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'c',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'e',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//6
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'f',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//7
                //合意書（書類）
                'image_title' => '合意書',
                //合意書画像
                'image_path' => 'g',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
