<?php

use Illuminate\Database\Seeder;

class advertisingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertisings')->insert([
            [//1
                //流入経路名
                'advertising_name' => 'クオカード1000/3000'
            ],
            [//2
                //流入経路名
                'advertising_name' => 'クオカード2000/5000'
            ],
            [//3
                //流入経路名
                'advertising_name' => 'クオカード5000'
            ],
            [//4
                //流入経路名
                'advertising_name' => '取次店'
            ],
            [//5
                //流入経路名
                'advertising_name' => '紹介キャンペーン'
            ]
        ]);
    }
}
