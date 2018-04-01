<?php

use Illuminate\Database\Seeder;

class SendMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('send_messages')->truncate();
        DB::table('send_messages')->insert([
            [
                'sender_id' => 1,
                'receivers_id' => "1,2",
                'title' => "Message 1",
                'message' => "Hi This is testing Message 1",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'sender_id' => 2,
                'receivers_id' => "1,2",
                'title' => "Message 2",
                'message' => "Hi This is testing Message 2",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
