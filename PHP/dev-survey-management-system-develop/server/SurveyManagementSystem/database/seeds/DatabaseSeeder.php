<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            //上から下の順番に実行

            authsTableSeeder::class,

            client_agreementsTableSeeder::class,

            client_bill_issuesTableSeeder::class,

            client_certificationsTableSeeder::class,

            client_drawingsTableSeeder::class,

            client_insurance_policiesTableSeeder::class,

            client_quotationsTableSeeder::class,

            client_reportsTableSeeder::class,

            client_statusesTableSeeder::class,

            advertisingsTableSeeder::class,

            matter_agreementsTableSeeder::class,

            matter_bill_issuesTableSeeder::class,

            matter_certificationsTableSeeder::class,

            matter_drawingsTableSeeder::class,

            matter_insurance_policiesTableSeeder::class,

            matter_quotationsTableSeeder::class,

            matter_reportsTableSeeder::class,

            matter_statusesTableSeeder::class,

            trader_contract_conclusionsTableSeeder::class,

            surveiesTableSeeder::class,

            tradersTableSeeder::class,

            usersTableSeeder::class,

            logsTableSeeder::class,

            clientsTableSeeder::class,

            mattersTableSeeder::class,

            rewardsTableSeeder::class,

        ]);
    }
}
