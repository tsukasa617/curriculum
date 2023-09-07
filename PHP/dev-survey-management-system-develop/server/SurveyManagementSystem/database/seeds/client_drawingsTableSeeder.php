<?php

use Illuminate\Database\Seeder;

class client_drawingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_drawings')->insert([
            [//1
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//2
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'b',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//3
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'c',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//4
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//5
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'e',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//6
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'f',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ],
            [//7
                //図面（書類）
                'image_title' => '図面',
                //図面画像
                'image_path' => 'g',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => NULL
            ]
        ]);
    }
}
