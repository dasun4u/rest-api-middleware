<?php

use Illuminate\Database\Seeder;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->truncate();
        DB::table('subscriptions')->insert([
            [
                'application_id' => 1,
                'service_id' => 1,
                'approved' => 1,
                'approved_by' => 1,
                'approved_at' => \Carbon\Carbon::now(),
                'subscribed_by' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'application_id' => 1,
                'service_id' => 2,
                'approved' => 1,
                'approved_by' => 1,
                'approved_at' => \Carbon\Carbon::now(),
                'subscribed_by' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'application_id' => 2,
                'service_id' => 3,
                'approved' => 1,
                'approved_by' => 1,
                'approved_at' => \Carbon\Carbon::now(),
                'subscribed_by' => 3,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'application_id' => 2,
                'service_id' => 4,
                'approved' => 1,
                'approved_by' => 1,
                'approved_at' => \Carbon\Carbon::now(),
                'subscribed_by' => 3,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
