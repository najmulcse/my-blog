<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([

            'name'      => 'Najmul ' ,
            'email'		=> 'najmul2022@gmail.com',
            'password'	=> bcrypt('najmul'),
            'user_type'	=> 1 ,
            'photo'		=> "",
            'created_at'=> \Carbon\Carbon::now(),
            'updated_at'=> \Carbon\Carbon::now()	

             ]);
    }
}
