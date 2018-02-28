<?php

use Illuminate\Database\Seeder;

class ServiceGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_groups')->truncate();
        DB::table('service_groups')->insert([
            [
                'name' => 'API Group 1',
                'description' => 'Testing API Group 1',
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'name' => 'API Group 2',
                'description' => 'Testing API Group 2',
                'active' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
