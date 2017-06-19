<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	for($i=1 ; $i<10 ;$i++){
        DB::table('posts')->insert([
                'category_id'   => $i,
                'user_id'		=> $i,
                'post_type'		=> $faker->randomElement($array = array('1','2','3')),
                'title'			=> $faker->name,
                'body'			=> $faker->text,
                'created_at'	=> $faker->dateTime($max = 'now'),
                'updated_at'	=> $faker->dateTime($max ='now')

                      ]);

        }
    }
}
