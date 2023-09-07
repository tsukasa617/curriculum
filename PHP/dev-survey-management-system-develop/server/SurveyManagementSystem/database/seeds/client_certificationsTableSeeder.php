<?php

use Illuminate\Database\Seeder;

class client_certificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_certifications')->insert([
            [//1
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'b',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'c',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'e',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//6
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'f',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//7
                //認定書（書類）
                'image_title' => '認定書',
                //認定書画像
                'image_path' => 'g',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
