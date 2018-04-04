<?php

use Illuminate\Database\Seeder;

class AppicationsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->truncate();
        DB::table('applications')->insert([
            [
                'name' => 'First APP',
                'description' => 'First Application for REST API Middleware',
                'token_validity' => 86400,
                'active' => 1,
                'approved' => 1,
                'approved_by' => 1,
                'created_by' => 2,
                'production_key' => 'R1Vld2dfUU5DVl9ucXp2YV9DRUJRSFBHVkJBXzE1MTc4NTI2MzBfbkhjdDE=',
                'production_secret' => 'IYWqinEDa8pHnk31S4NbHKBVPq3XhM9zjgymPq9w',
                'sandbox_key' => 'dUg5Y3NfUU5DVl9ucXp2YV9GTkFRT0JLXzE1MTc4NTI3MTlfNUh3YU4=',
                'sandbox_secret' => 'fdbCMrcc5cSlsuHoSNBPIS6xdz7reLNrQhGrMmNo',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Second APP',
                'description' => 'Second Application for REST API Middleware',
                'token_validity' => 86400,
                'active' => 0,
                'approved' => 0,
                'approved_by' => 0,
                'created_by' => 2,
                'production_key' => 'T2tDWmZfUU5DVl9ucXp2YV9DRUJRSFBHVkJBXzE1MjI4NjA5ODFfQVJOc1E=',
                'production_secret' => 'LOKK07MPOymKYUCmvMK2Mccft02BbA2RwwUd19G9',
                'sandbox_key' => 'TlNtUGFfUU5DVl9ucXp2YV9GTkFRT0JLXzE1MjI4NjA5ODVfUDdaeUE=',
                'sandbox_secret' => '620BHbkmmNEHBD82iu6mO3L8zu0syA9wxplIEIDJ',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
