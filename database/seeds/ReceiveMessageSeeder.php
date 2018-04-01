<?php

use Illuminate\Database\Seeder;

class ReceiveMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('receive_messages')->truncate();
        DB::table('receive_messages')->insert([
            [
                'send_message_id' => 1,
                'receiver_id' => 1,
                'is_read' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'send_message_id' => 1,
                'receiver_id' => 2,
                'is_read' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'send_message_id' => 2,
                'receiver_id' => 1,
                'is_read' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'send_message_id' => 2,
                'receiver_id' => 2,
                'is_read' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
