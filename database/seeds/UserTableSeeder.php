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
       $faker =Faker\Factory::create();
       
       //For admin

       DB::table('users')->insert([

            'name'      => 'Najmul ' ,
            'email'		=> 'najmul2022@gmail.com',
            'password'	=> bcrypt('najmul'),
            'user_type'	=> 1 ,
            'photo'		=> "",
            'created_at'=> \Carbon\Carbon::now(),
            'updated_at'=> \Carbon\Carbon::now()	

             ]);

       //For users

       for($i=2 ;$i <10; $i++)
       {
        DB::table('users')->insert([

             'name'      => $faker->name ,
             'email'        => 'user'.$i.'@gmail.com',
             'password' => bcrypt('123456'),
             'user_type'    => 2,
             'photo'        => "",
             'created_at'=> \Carbon\Carbon::now(),
             'updated_at'=> \Carbon\Carbon::now()   

              ]);

       }
    }
}
