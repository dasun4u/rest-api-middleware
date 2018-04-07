<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->truncate();
        DB::table('services')->insert([
            [
                'name' => 'Service 1',
                'approved' => 1,
                'active' => 1,
                'context' => 'service1',
                'production_uri' => 'http://dapiservice.com/api/production/service_group_1/service_1',
                'sandbox_uri' => 'http://dapiservice.com/api/sandbox/service_group_1/service_1',
                'method' => 'GET',
                'description' => 'Testing Service 1',
                'service_group_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Service 2',
                'approved' => 1,
                'active' => 1,
                'context' => 'service2',
                'production_uri' => 'http://dapiservice.com/api/production/service_group_1/service_2',
                'sandbox_uri' => 'http://dapiservice.com/api/sandbox/service_group_1/service_2',
                'method' => 'POST',
                'description' => 'Testing Service 2',
                'service_group_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Service 3',
                'approved' => 1,
                'active' => 1,
                'context' => 'service3',
                'production_uri' => 'http://dapiservice.com/api/production/service_group_2/service_3',
                'sandbox_uri' => 'http://dapiservice.com/api/sandbox/service_group_2/service_3',
                'method' => 'GET',
                'description' => 'Testing Service 3',
                'service_group_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'Service 4',
                'approved' => 1,
                'active' => 1,
                'context' => 'service4',
                'production_uri' => 'http://dapiservice.com/api/production/service_group_2/service_4',
                'sandbox_uri' => 'http://dapiservice.com/api/sandbox/service_group_2/service_4',
                'method' => 'POST',
                'description' => 'Testing Service 4',
                'service_group_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
