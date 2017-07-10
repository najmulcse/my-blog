<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
             'post_id' =>1 ,
             'user_id' =>1 ,
             'body'    =>'Hey , this is my first comment'
           ]);
        DB::table('comments')->insert([
             'post_id' =>2 ,
             'user_id' =>1 ,
             'body'    =>'Hey , this is my 2nd comment'
           ]);
    }
}
