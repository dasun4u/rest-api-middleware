<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'active' => 1,
                'first_name' => 'Dasun',
                'last_name' => 'Dissanayake',
                'username' => 'admin',
                'password' => bcrypt('1qaz2wsx'),
                'email' => 'dpdasun@gmail.com',
                'mobile' => '0710474824',
                'avatar' => '/assets/avatar/admin.jpg',
            ], [
                'active' => 1,
                'first_name' => 'Shalinda',
                'last_name' => 'Suresh',
                'username' => 'shalinda',
                'password' => bcrypt('1qaz2wsx'),
                'email' => 'shalinda@arimaclanka.com',
                'mobile' => '0710474824',
                'avatar' => null,
            ], [
                'active' => 0,
                'first_name' => 'Thusitha',
                'last_name' => 'Karavita',
                'username' => 'thusitha',
                'password' => bcrypt('1qaz2wsx'),
                'email' => 'thusitha@arimaclanka.com',
                'mobile' => '0710474824',
                'avatar' => null,
            ], [
                'active' => 0,
                'first_name' => 'Ruwan',
                'last_name' => 'Prabash',
                'username' => 'ruwan',
                'password' => bcrypt('1qaz2wsx'),
                'email' => 'ruwan@arimaclanka.com',
                'mobile' => '0710474824',
                'avatar' => null,
            ]
        ]);

    }
}
