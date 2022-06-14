<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'username'=>'Admin',
            'password'=>bcrypt('admin'),
            'email'=>'admin@gmail.com',
            'address'=>'65 Huynh Thuc Khang Street, Ben Nghe Ward, District 1, Ho Chi Minh City',
            'birthday'=>Carbon::now(),
            'phone'=>'98754321',
            'gender'=>1,
            'created_at'=>Carbon::now(),
        ];
        DB::table('users')->insert($data);
    }
}
