<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AppicationsTablesSeeder::class);
        $this->call(ServiceGroupsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
        $this->call(SendMessageSeeder::class);
        $this->call(ReceiveMessageSeeder::class);
    }
}
